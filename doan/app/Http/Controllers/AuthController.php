<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'status' => 1,
            'is_delete' => 0,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where(function ($query) use ($request) {
            $query->where('username', $request->username)
                  ->orWhere('email', $request->username);
        })
        ->where('status', 1)
        ->where('is_delete', 0)
        ->first();
        if ($user && Hash::check($request->password, $user->password)) {

            // Đăng nhập người dùng và tạo session mới
            Auth::login($user, true);
            $request->session()->regenerate();

            // Điều hướng theo vai trò user
            if ($user->role_id == 2 || $user-> role_id == 3) {
                // Nếu là ADMIN (role_id == 2): Đăng nhập và chuyển hướng tới Admin Dashboard
                // KHÔNG tăng lượt truy cập.
                return redirect()->route('admin.dashboard');
            }

            // Nếu là USER thường (role_id != 2):

            // 1. TĂNG LƯỢT ĐĂNG NHẬP CÁ NHÂN (users.visits)
            // Sau khi đăng nhập thành công, tăng cột visits của người dùng hiện tại lên 1
            $user->increment('visits');

            // 2. Tăng lượt truy cập CHUNG hệ thống (visits table)
            DB::table('visits')->updateOrInsert(
                [],  // chỉ có 1 dòng duy nhất
                [
                    'counter' => DB::raw('counter + 1'),
                    'updated_at' => now(),
                ]
            );

            // Chuyển hướng tới User Dashboard
            return redirect()->route('user.dashboard');
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, true);
            $request->session()->regenerate();
            
            if ($user->role_id == 2 || $user->role_id == 3) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['username' => 'Thông tin đăng nhập không hợp lệ.'])->withInput();
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
