<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;

class PayPalController extends Controller
{
    /**
     * Lấy cấu hình PayPal
     */
    private function paypal()
    {
        $mode = config('services.paypal.mode');

        return [
            'base_url'   => $mode === 'live'
                ? 'https://api-m.paypal.com'
                : 'https://api-m.sandbox.paypal.com',
            'client_id'  => config('services.paypal.client_id'),
            'secret'     => config('services.paypal.client_secret'),
            'currency'   => config('services.paypal.currency', 'USD'),
        ];
    }

    /**
     * Tạo AccessToken của PayPal
     */
    private function accessToken()
    {
        $paypal = $this->paypal();

        $response = Http::asForm()
            ->withBasicAuth($paypal['client_id'], $paypal['secret'])
            ->post($paypal['base_url'] . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        return $response['access_token'];
    }

    /**
     * Tạo PayPal Order
     */
    public function createOrder(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $total = $carts->sum(fn($c) => $c->product->price * $c->quantity);

        $paypal      = $this->paypal();
        $accessToken = $this->accessToken();

        $response = Http::withToken($accessToken)
            ->post($paypal['base_url'] . '/v2/checkout/orders', [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "amount" => [
                        "currency_code" => $paypal['currency'],
                        "value"         => number_format($total, 2, '.', '')
                    ]
                ]],
                "application_context" => [
                    "brand_name"          => "Aptech Shop",
                    "landing_page"        => "LOGIN",
                    "user_action"         => "PAY_NOW",
                    "shipping_preference" => "NO_SHIPPING"
                ]
            ]);

        return response()->json([
            'id' => $response['id']
        ]);
    }

    /**
     * Capture PayPal Order → Lưu vào DB
     */
    public function captureOrder(Request $request)
    {
        try {
            $orderID = $request->orderID;

            if (!$orderID) {
                return response()->json(['error' => 'orderID missing'], 400);
            }

            $paypal      = $this->paypal();
            $accessToken = $this->accessToken();
            $url         = $paypal['base_url'] . "/v2/checkout/orders/{$orderID}/capture";

            // Capture không gửi body
            $capture = Http::withToken($accessToken)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->send('POST', $url);

            Log::info('PayPal Capture Response', [
                'status' => $capture->status(),
                'body'   => $capture->body(),
            ]);

            $data = $capture->json();

            // Kiểm tra trạng thái PayPal COMPLETED
            $rootStatus  = $data['status'] ?? null;
            $innerStatus = $data['purchase_units'][0]['payments']['captures'][0]['status'] ?? null;

            if ($rootStatus !== 'COMPLETED' && $innerStatus !== 'COMPLETED') {
                return response()->json([
                    'error'           => 'PayPal capture error',
                    'paypal_response' => $data,
                ], 400);
            }

            // Tạo đơn hàng trong DB
            $user  = Auth::user();
            $carts = Cart::with('product')->where('user_id', $user->id)->get();

            if ($carts->isEmpty()) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            $total = $carts->sum(fn($c) => $c->product->price * $c->quantity);

            $order = Order::create([
                'user_id'          => $user->id,

                // 🆕 Thông tin người nhận
                'receiver_name'    => $request->full_name,
                'receiver_email'   => $request->email,
                'delivery_phone'   => $request->phone,
                'delivery_address' => $request->address,
                'payment_method'   => $request->payment_method,

                // 🧾 Thông tin đơn hàng
                'total_price'      => $total,
                'pay'              => $total,
                'purchase_date'    => now(),
                'status'           => 'pending',
            ]);


            foreach ($carts as $item) {

                $product = $item->product;

                // 🛑 Nếu vì lý do gì đó product không tồn tại
                if (!$product) continue;

                // 🛑 Kiểm tra stock
                if ($product->stock < $item->quantity) {
                    return response()->json([
                        'error' => "Product {$product->name} does not have enough stock!",
                        'available' => $product->stock
                    ], 400);
                }

                // 🟢 Trừ stock
                $product->stock -= $item->quantity;
                $product->save();

                // 🟢 Lưu order detail
                OrderDetail::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->product_id,
                    'quantity'      => $item->quantity,
                    'price'         => $product->price,
                    'selling_price' => $product->price,
                    'purchase_date' => now(),
                    'status'        => 'pending',
                ]);
            }


            // Xoá giỏ hàng
            Cart::where('user_id', $user->id)->delete();

            return response()->json([
                'success'  => true,
                'redirect' => route('user.profile', ['success' => 'ordered']),
            ]);
        } catch (\Exception $e) {
            Log::error("PayPal Capture Exception", ['message' => $e->getMessage()]);

            return response()->json([
                'error'   => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
