<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng của user
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form')
                ->with('error', 'Please log in to view your cart');
        }

        $carts = Cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        return view('user.cart', compact('carts'));
    }

    /**
     * Xóa 1 sản phẩm khỏi giỏ hàng
     */
    public function remove($id)
    {
        $cart = Cart::findOrFail($id);

        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart_user')->with('success', 'Product removed from cart');
    }

    /**
     * Thêm sản phẩm vào giỏ hàng (Ajax hoặc Form)
     */
    public function add(Request $request)
    {
        Log::info('🛒 ADD TO CART => REQUEST', $request->all());

        if (!Auth::check()) {
            return response()->json(['error' => 'unauthenticated'], 401);
        }

        $productId = (int) $request->input('product_id');
        $quantity  = (int) ($request->input('quantity', 1));

        if (!$productId) {
            return response()->json(['error' => 'missing_product_id'], 422);
        }

        $product = \App\Models\Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'invalid_product'], 422);
        }

        $userId = Auth::id();

        // Kiểm tra sản phẩm đã có trong cart chưa?
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        $newQuantity = $cartItem ? ($cartItem->quantity + $quantity) : $quantity;

        // ❗ CHECK STOCK
        if ($newQuantity > $product->stock) {
            return response()->json([
                'success' => false,
                'error' => 'not_enough_stock',
                'message' => 'Not enough stock available for the product!',
                'available' => $product->stock
            ], 422);
        }

        // Nếu hợp lệ → lưu lại cart
        if ($cartItem) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id'    => $userId,
                'product_id' => $productId,
                'quantity'   => $quantity,
            ]);
        }

        // Cập nhật tổng quantity
        $totalQty = Cart::where('user_id', $userId)->sum('quantity');

        return response()->json([
            'success' => true,
            'total' => $totalQty,
        ]);
    }



    /**
     * Cập nhật số lượng sản phẩm trong giỏ
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::with('product')->findOrFail($id);

        if ($cart->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $product = $cart->product;

        // ❗ Kiểm tra stock
        if ($request->quantity > $product->stock) {
            return response()->json([
                'success' => false,
                'error' => 'not_enough_stock',
                'message' => 'Quantity exceeds available stock!',
                'available' => $product->stock
            ], 422);
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json(['success' => true, 'message' => 'Cart updated']);
    }


    /**
     * Hiển thị trang checkout
     */
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')
                ->with('error', 'You need to log in to proceed with the checkout.');
        }

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $carts->sum(function ($cart) {
            return ($cart->product->price ?? 0) * $cart->quantity;
        });

        $shipping = 10;
        $total = $subtotal + $shipping;

        return view('user.checkout', compact('carts', 'subtotal', 'total'));
    }

    /**
     * Thanh toán — tạm thời yêu cầu dùng PayPal
     */
    public function store(Request $request)
    {
        return redirect()->back()->with('error', 'Please use PayPal to complete your order.');
    }
}
