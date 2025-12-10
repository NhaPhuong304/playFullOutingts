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

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
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
        ->where('is_delete', 0)
        ->first();

    if (!$user) {
        return back()->withErrors(['username' => 'Account does not exist'])->withInput();
    }

    if ($user->status == 0) {
        return back()->withErrors(['username' => 'Account has been disabled!'])->withInput();
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
    }


    Auth::login($user, true);
    $request->session()->regenerate();


    if ($user->role_id == 2 || $user->role_id == 3) {
        return redirect()->route('admin.dashboard');
    }

    $user->increment('visits');

    DB::table('visits')->updateOrInsert(
        [],
        [
            'counter' => DB::raw('counter + 1'),
            'updated_at' => now(),
        ]
    );

    return redirect()->route('user.dashboard');
}

    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
