<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\RecycleUserController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


// Authentication
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected dashboards
Route::middleware(['role:user', 'check.password'])->group(function () {
    Route::get('user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    
    // Set password for Google OAuth users
    Route::get('set-password', [SetPasswordController::class, 'show'])->name('set-password.show');
    Route::post('set-password', [SetPasswordController::class, 'store'])->name('set-password.store');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/dashboard', function () { return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('admin/user', [UserController::class, 'user'])->name('admin.user');
    Route::put('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
    Route::post('admin/user/add', [UserController::class, 'store'])->name('admin.user.store');

    Route::get('admin/trashUser', [RecycleUserController::class, 'trash'])->name('admin.trashUser');
    Route::post('admin/recycle-user/restore', [RecycleUserController::class, 'restore'])->name('admin.recycleUser.restore');
    Route::delete('admin/recycle-user/delete/{id}', [RecycleUserController::class, 'delete'])->name('admin.recycleUser.delete');



    Route::get('admin/category', [CategoryController::class, 'category'])->name('admin.category');
    Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::post('admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('admin/game', [GameController::class, 'game'])->name('admin.game');
    Route::post('admin/game/add', [GameController::class, 'add'])->name('admin.game.add');
    Route::put('admin/game/{id}', [GameController::class, 'update'])->name('admin.game.update');
    Route::delete('admin/game/{id}', [GameController::class, 'delete'])->name('admin.game.delete');


});


// Social OAuth
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('oauth.google.callback');

// Password reset with code via email
Route::get('password/forgot', [PasswordResetController::class, 'showRequest'])->name('password.request');
Route::post('password/forgot', [PasswordResetController::class, 'sendCode'])->name('password.forgot.post');
Route::get('password/verify', [PasswordResetController::class, 'showVerify'])->name('password.verify');
Route::post('password/verify', [PasswordResetController::class, 'verifyCode'])->name('password.verify.post');
Route::get('password/reset', [PasswordResetController::class, 'showReset'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.reset.post');
