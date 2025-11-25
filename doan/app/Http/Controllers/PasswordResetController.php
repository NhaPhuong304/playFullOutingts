<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    // Show request form
    public function showRequest()
    {
        return view('auth.passwords.forgot');
    }

    // Handle sending code to user's email
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // find by email only
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy tài khoản với email này.']);
        }

        // Generate 6-digit code
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Save hashed code in password_resets
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($code),
                'created_at' => Carbon::now(),
            ]
        );

        // Send email with code (simple text email) and log errors
        try {
            Mail::raw("Mã đặt lại mật khẩu của bạn: {$code}\nMã có hiệu lực 60 phút.", function ($m) use ($user) {
                $m->to($user->email)->subject('Mã đặt lại mật khẩu');
            });
        } catch (\Exception $e) {
            // Log the mail error for diagnosis
            Log::error('Password reset mail error: ' . $e->getMessage());

            // If we're running in local/dev, allow a developer fallback so testing can continue
            if (app()->environment('local') || config('app.debug')) {
                // Put email and the plain code in session so the verify step can proceed
                $request->session()->put('password_reset_email', $user->email);
                // Store the dev code in session for display (only in non-production)
                $request->session()->put('password_reset_dev_code', $code);
                return redirect()->route('password.verify')->with('success', "Mã đã được tạo (dev): {$code}");
            }

            return back()->withErrors(['email' => 'Không thể gửi email. Kiểm tra cấu hình mail.']);
        }

        // Store email in session for verification step
        $request->session()->put('password_reset_email', $user->email);

        return redirect()->route('password.verify')->with('success', 'Mã đã được gửi tới email của bạn.');
    }

    // Show verify code form
    public function showVerify(Request $request)
    {
        $email = $request->session()->get('password_reset_email');
        if (!$email) {
            return redirect()->route('password.request');
        }
        return view('auth.passwords.verify');
    }

    // Verify the code
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $email = $request->session()->get('password_reset_email');
        if (!$email) {
            return redirect()->route('password.request');
        }

        $record = DB::table('password_resets')->where('email', $email)->first();
        if (!$record) {
            return redirect()->route('password.request')->withErrors(['identity' => 'Yêu cầu đặt lại mật khẩu không tồn tại.']);
        }

        // check expiry (60 minutes)
        $created = Carbon::parse($record->created_at);
        if (Carbon::now()->diffInMinutes($created) > 60) {
            DB::table('password_resets')->where('email', $email)->delete();
            return redirect()->route('password.request')->withErrors(['identity' => 'Mã đã hết hạn. Vui lòng yêu cầu lại.']);
        }

        if (!Hash::check($request->input('code'), $record->token)) {
            return back()->withErrors(['code' => 'Mã không hợp lệ.']);
        }

        // mark verified in session
        $request->session()->put('password_reset_verified', true);

        return redirect()->route('password.reset');
    }

    // Show reset form
    public function showReset(Request $request)
    {
        $email = $request->session()->get('password_reset_email');
        $verified = $request->session()->get('password_reset_verified');
        if (!$email || !$verified) {
            return redirect()->route('password.request');
        }
        return view('auth.passwords.reset');
    }

    // Perform password reset
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $email = $request->session()->get('password_reset_email');
        $verified = $request->session()->get('password_reset_verified');
        if (!$email || !$verified) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('password.request')->withErrors(['identity' => 'Tài khoản không tồn tại.']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Delete password reset record and session flags
        DB::table('password_resets')->where('email', $email)->delete();
        $request->session()->forget(['password_reset_email', 'password_reset_verified']);

        return redirect()->route('login')->with('success', 'Mật khẩu đã được thay đổi. Vui lòng đăng nhập.');
    }
}
