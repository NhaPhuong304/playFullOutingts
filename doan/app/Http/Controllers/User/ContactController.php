<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Contact as ContactModel;
use Illuminate\Support\Facades\DB;


class ContactController extends Controller
{
    public function contact()
    {
        return view('user/contact');
    }

    // AJAX endpoint to generate a simple math captcha
    public function generateCaptcha(Request $request)
    {
        // Prefer using a static base image if present in public/storage/captcha
        $staticPathPng = public_path('storage/captcha/captcha-base.png');
        $staticPathJpg = public_path('storage/captcha/captcha-base.jpg');

        if (file_exists($staticPathPng) || file_exists($staticPathJpg)) {
            $usePath = file_exists($staticPathPng) ? $staticPathPng : $staticPathJpg;
            $ext = strtolower(pathinfo($usePath, PATHINFO_EXTENSION));
            try {
                if ($ext === 'png') {
                    $im = imagecreatefrompng($usePath);
                } else {
                    // default to jpeg loader
                    $im = imagecreatefromjpeg($usePath);
                }
            } catch (\Exception $e) {
                Log::warning('Failed loading static captcha base image, falling back to generated one: ' . $e->getMessage());
                $im = null;
            }
        } else {
            $im = null;
        }

        // If no static image loaded, generate a simple patterned base as before
        if ($im === null) {
            $width = 300;
            $height = 120;

            $im = imagecreatetruecolor($width, $height);
            // background colors
            $bg = imagecolorallocate($im, 230, 245, 255);
            $dark = imagecolorallocate($im, 100, 150, 200);
            imagefilledrectangle($im, 0, 0, $width, $height, $bg);

            // draw some random rectangles/ellipses as background texture
            for ($i = 0; $i < 6; $i++) {
                $c = imagecolorallocate($im, rand(200, 240), rand(200, 240), rand(230, 255));
                imagefilledellipse($im, rand(0, $width), rand(0, $height), rand(30, 120), rand(20, 80), $c);
            }
        }

        // determine base size
        $width = imagesx($im);
        $height = imagesy($im);

        // choose piece size and position (ensure it fits within base)
        $pieceW = min(35, (int) max(20, floor($width * 0.08)));
        $pieceH = min(35, (int) max(20, floor($height * 0.25)));
        $minX = (int) max(10, floor($width * 0.2));
        $maxX = (int) max($minX + 10, $width - $pieceW - 20);
        $targetX = rand($minX, $maxX);
        $targetY = rand(10, max(10, $height - $pieceH - 10));

        // create the piece image by copying region from base image
        $piece = imagecreatetruecolor($pieceW, $pieceH);
        // fill piece background transparent-like (we will use PNG)
        $trans = imagecolorallocatealpha($piece, 0, 0, 0, 127);
        imagefill($piece, 0, 0, $trans);
        imagesavealpha($piece, true);
        imagecopy($piece, $im, 0, 0, $targetX, $targetY, $pieceW, $pieceH);

        // draw a visible hole on base image (lighten area)
        $holeColor = imagecolorallocate($im, 200, 220, 235);
        imagefilledrectangle($im, $targetX, $targetY, $targetX + $pieceW, $targetY + $pieceH, $holeColor);

        // Add a border around hole
        $border = imagecolorallocate($im, 160, 190, 215);
        imagerectangle($im, $targetX, $targetY, $targetX + $pieceW, $targetY + $pieceH, $border);

        // prepare base64 outputs
        ob_start();
        imagepng($im);
        $baseImg = ob_get_clean();
        imagedestroy($im);

        ob_start();
        imagepng($piece);
        $pieceImg = ob_get_clean();
        imagedestroy($piece);

        $id = (string) Str::uuid();
        // store expected x (targetX) and tolerance in session
        session(["captcha.{$id}" => ['x' => $targetX, 'y' => $targetY, 'w' => $pieceW, 'h' => $pieceH, 'tolerance' => 8]]);
        
        Log::info('Captcha generated', [
            'captcha_id' => $id,
            'session_id' => session()->getId(),
            'target_x' => $targetX,
            'stored_in_session' => session()->get("captcha.{$id}"),
            'base_from' => (isset($usePath) ? $usePath : 'generated')
        ]);

        $base64 = 'data:image/png;base64,' . base64_encode($baseImg);
        $piece64 = 'data:image/png;base64,' . base64_encode($pieceImg);

        return response()->json(['id' => $id, 'image' => $base64, 'piece' => $piece64, 'w' => $pieceW, 'h' => $pieceH, 'y' => $targetY, 'x' => $targetX, 'baseW' => $width, 'baseH' => $height, 'tolerance' => 8]);
    }

    // Handle contact form submission and validate the captcha
    public function send(Request $request)
    {
        $isAjax = $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest';
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
            'captcha_id' => 'required|string',
            'captcha_answer' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            if ($isAjax) {
                return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = $request->input('captcha_id');
        $given = $request->input('captcha_answer');
        
        Log::info('Captcha submit attempt', [
            'received_id' => $id,
            'session_id' => session()->getId(),
            'session_has_key' => session()->has("captcha.{$id}"),
            'session_value' => session()->get("captcha.{$id}"),
            'all_session_keys' => array_keys(session()->all())
        ]);

        $expected = session("captcha.{$id}");

        // If the specific captcha id is not found, attempt a safe fallback:
        // scan any existing captchas in session and match by given X within tolerance.
        if ($expected === null) {
            Log::info('Captcha id not found in session, attempting fallback search', ['captcha_id' => $id, 'session_id' => session()->getId()]);
            $all = session('captcha', []);
            $foundKey = null;
            foreach ($all as $key => $val) {
                // ensure structure as expected
                if (!is_array($val) || !isset($val['x'])) continue;
                $tol = isset($val['tolerance']) ? (int) $val['tolerance'] : 8;
                $givenX = (int) round(floatval($given));
                if (abs($givenX - (int) $val['x']) <= $tol) {
                    $foundKey = $key;
                    $expected = $val;
                    Log::info('Captcha fallback matched session entry', ['matched_key' => $key, 'given_x' => $givenX, 'target_x' => $val['x'], 'tolerance' => $tol]);
                    break;
                }
            }

            if ($expected === null) {
                Log::warning('Captcha session not found', ['captcha_id' => $id]);

                // Defensive: if the same contact (email+message+ip) was already saved very recently,
                // treat this as an idempotent retry and return success to the user instead of "expired".
                try {
                    $recent = ContactModel::where('email', $request->input('email'))
                        ->where('message', $request->input('message'))
                        ->where('ip', $request->ip())
                        ->where('created_at', '>=', now()->subMinutes(2))
                        ->exists();
                    if ($recent) {
                        Log::info('Duplicate recent contact detected; returning success for idempotent retry', ['email' => $request->input('email'), 'ip' => $request->ip()]);
                        if ($isAjax) {
                            return response()->json(['success' => true, 'message' => 'Message sent successfully.']);
                        }
                        return redirect()->back()->with('success', 'Message sent successfully.');
                    }
                } catch (\Exception $e) {
                    Log::warning('Idempotent duplicate-check failed: ' . $e->getMessage());
                }

                if ($isAjax) {
                    return response()->json(['success' => false, 'message' => 'Captcha expired or invalid.'], 400);
                }
                return redirect()->back()->withErrors(['captcha' => 'Captcha expired or invalid.'])->withInput();
            }

            // if we matched a different key via fallback, use that id for cleanup later
            if (isset($foundKey) && $foundKey !== $id) {
                $id = $foundKey;
            }
        }

        // given should be numeric (x coordinate) - compare with stored expected x within tolerance
        $givenX = (int) round(floatval($given));
        $targetX = isset($expected['x']) ? (int) $expected['x'] : null;
        $tolerance = isset($expected['tolerance']) ? (int) $expected['tolerance'] : 8;

        if ($targetX === null || abs($givenX - $targetX) > $tolerance) {
            Log::warning('Captcha validation failed', [
                'captcha_id' => $id,
                'given_x' => $givenX,
                'target_x' => $targetX,
                'tolerance' => $tolerance,
                'difference' => $targetX !== null ? abs($givenX - $targetX) : null
            ]);
            if ($isAjax) {
                return response()->json(['success' => false, 'message' => 'Captcha is incorrect.'], 400);
            }
            return redirect()->back()->withErrors(['captcha' => 'Captcha is incorrect.'])->withInput();
        }

        // Store contact into DB for admin panel inside a transaction.
        try {
            DB::beginTransaction();
            $contact = ContactModel::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'message' => $request->input('message'),
                'ip' => $request->ip(),
                'user_agent' => substr($request->header('User-Agent') ?? '', 0, 512),
            ]);
            DB::commit();

            // Remove captcha after successful save
            session()->forget("captcha.{$id}");
            Log::info('Captcha removed after successful DB save', ['captcha_id' => $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Contact DB save error: ' . $e->getMessage());
            if ($isAjax) {
                return response()->json(['success' => false, 'message' => 'Database error: Could not save message.'], 500);
            }
            return redirect()->back()->withErrors(['db' => 'Không thể lưu thông điệp, vui lòng thử lại.'])->withInput();
        }

        // Send email/notification to admin with contact details
        $adminEmail = env('ADMIN_EMAIL', config('mail.from.address'));
        $body = "New contact message:\n\n" .
            "Name: " . $request->input('name') . "\n" .
            "Email: " . $request->input('email') . "\n" .
            "Message:\n" . $request->input('message') . "\n\n" .
            "IP: " . $request->ip() . "\n" .
            "User Agent: " . substr($request->header('User-Agent') ?? '', 0, 200);

        try {
            Mail::raw($body, function ($m) use ($adminEmail) {
                $m->to($adminEmail)->subject('New contact message from website');
            });
        } catch (\Exception $e) {
            Log::error('Contact mail error: ' . $e->getMessage());
            if (app()->environment('local') || config('app.debug')) {
                // In dev, keep user flow but store message in session so admin can inspect
                session()->push('dev_contact_messages', $body);
                if ($isAjax) {
                    return response()->json(['success' => true, 'message' => 'Message recorded (dev).']);
                }
                return redirect()->back()->with('success', 'Message recorded (dev).');
            }
            if ($isAjax) {
                return response()->json(['success' => false, 'message' => 'Mail config error.'], 500);
            }
            return redirect()->back()->withErrors(['mail' => 'Không thể gửi thông báo tới quản trị. Kiểm tra cấu hình mail.']);
        }

        if ($isAjax) {
            return response()->json(['success' => true, 'message' => 'Message sent successfully.']);
        }
        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
