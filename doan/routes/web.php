<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RecycleCategoryController;
use App\Http\Controllers\Admin\RecycleGameController;
use App\Http\Controllers\Admin\RecycleUserController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ItineraryAdminController;
use App\Http\Controllers\User\AboutusController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\BlogUserController;
use App\Http\Controllers\User\ChatController as UserChatController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\GameController as UserGameController;
use App\Http\Controllers\User\ItineraryController as UserItineraryController;
use App\Http\Controllers\User\SetPasswordController as UserSetPasswordController;
use App\Http\Controllers\User\SocialAuthController as UserSocialAuthController;

// Route::get('/', function () {
//     return redirect()->route('user.dashboard');
// });
Route::get('/', [DashboardController::class, 'dashboard']);



// Route::get('user/dashboard', function () {
//         return view('user.dashboard');
//     })->name('user.dashboard');

Route::get('user/dashboard', [DashboardController::class, 'dashboard'])
    ->name('user.dashboard');

Route::get('/user/game', [UserGameController::class, 'game'])->name('user.game');
Route::get('/user/detailGame/{slug}', [UserGameController::class, 'detailGame'])->name('user.detailGame');
Route::get('/user/game/category/{slug}', [UserGameController::class, 'categoryGame'])
    ->name('user.categoryGame');


Route::get('user/aboutus', [AboutusController::class, 'aboutus'])->name('user.aboutus');
Route::get('user/itinerary', [UserItineraryController::class, 'itinerary'])->name('user.itinerary');
Route::get('user/detailItinerary', [UserItineraryController::class, 'detailItinerary'])->name('user.detailItinerary');
Route::get('user/contact', [UserContactController::class, 'contact'])->name('user.contact');

// Blog pages for user
Route::get('/blog', [BlogUserController::class, 'index'])->name('user.blog.index');
Route::get('/blog/{id}', [BlogUserController::class, 'show'])->name('user.blog.show');

// Authentication
Route::get('register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('register', [UserAuthController::class, 'register'])->name('register.post');

Route::get('login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('login', [UserAuthController::class, 'login'])->name('login.post');

Route::post('logout', [UserAuthController::class, 'logout'])->name('logout');

// Protected dashboards
Route::middleware(['role:user', 'check.password'])->group(function () {
    // Route::get('user/dashboard', function () {
    //     return view('user.dashboard');
    // })->name('user.dashboard');
    
    // Set password for Google OAuth users
    Route::get('set-password', [UserSetPasswordController::class, 'show'])->name('set-password.show');
    Route::post('set-password', [UserSetPasswordController::class, 'store'])->name('set-password.store');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('admin/dashboard', function () { return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('admin/user', [UserController::class, 'user'])->name('admin.user');
    Route::put('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::put('/admin/user/{user}/block', [UserController::class, 'block'])->name('admin.user.block');
    Route::post('admin/user/add', [UserController::class, 'store'])->name('admin.user.store');

    Route::get('admin/trashUser', [RecycleUserController::class, 'trash'])->name('admin.trashUser');
    Route::post('admin/recycle-user/restore/{id}', [RecycleUserController::class, 'restore'])->name('admin.recycleUser.restore');
    Route::delete('admin/recycle-user/delete/{id}', [RecycleUserController::class, 'delete'])->name('admin.recycleUser.delete');



    Route::get('admin/category', [CategoryController::class, 'category'])->name('admin.category');
    Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::put('/admin/category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('admin/category/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('admin/trashCategory', [RecycleCategoryController::class, 'trash'])->name('admin.trashCategory');
    Route::delete('admin/recycle-category/delete/{id}', [RecycleCategoryController::class, 'delete'])->name('admin.recycleCategory.delete');
    Route::post('admin/recycle-category/restore/{id}', [RecycleCategoryController::class, 'restore'])->name('admin.recycleCategory.restore');

    Route::get('admin/game', [GameController::class, 'game'])->name('admin.game');
    Route::post('admin/game/add', [GameController::class, 'add'])->name('admin.game.add');
    Route::put('admin/game/{id}', [GameController::class, 'update'])->name('admin.game.update');
    Route::delete('admin/game/{id}', [GameController::class, 'delete'])->name('admin.game.delete');

    Route::get('admin/trashGame', [RecycleGameController::class, 'trash'])->name('admin.trashGame');
    Route::delete('admin/recycle-game/delete/{id}', [RecycleGameController::class, 'delete'])->name('admin.recycleGame.delete');
    Route::post('admin/recycle-game/restore/{id}', [RecycleGameController::class, 'restore'])->name('admin.recycleGame.restore');


    Route::get('admin/material', [MaterialController::class, 'material'])->name('admin.material');
    Route::post('admin/material/add', [MaterialController::class, 'add'])->name('admin.material.add');
    Route::put('admin/material/{id}', [MaterialController::class, 'update'])->name('admin.material.update');
    Route::delete('admin/material/{id}', [MaterialController::class, 'delete'])->name('admin.material.delete');

    Route::get('admin/profile/{id}', [ProfileController::class,'profile'])->name('admin.profile');
    Route::post('admin/profile/{id}/update', [ProfileController::class,'updateProfile'])->name('admin.profile.update');
    Route::post('admin/profile/{id}/change-password', [ProfileController::class,'changePassword'])->name('admin.profile.changePassword');

    Route::get('admin/itineraries', [ItineraryAdminController::class, 'itineraries'])->name('admin.itineraries');
    Route::post('admin/itineraries/add', [ItineraryAdminController::class, 'add'])->name('admin.itineraries.add');
    Route::get('admin/itineraries/{id}', [ItineraryAdminController::class, 'show'])->name('admin.itineraries.show');
    Route::post('admin/itineraries/update/{id}', [ItineraryAdminController::class, 'update'])->name('admin.itineraries.update');
    Route::delete('admin/itineraries/delete/{id}', [ItineraryAdminController::class, 'delete'])->name('admin.itineraries.delete');
    
    Route::get('admin/locations', [LocationController::class, 'location'])->name('admin.locations');
    Route::post('admin/locations/add', [LocationController::class, 'add'])->name('admin.locations.add');
    Route::post('admin/locations/update/{id}', [LocationController::class, 'update'])->name('admin.locations.update');
    Route::delete('admin/locations/delete/{id}', [LocationController::class, 'destroy'])->name('admin.locations.delete');

    // BLOG MANAGEMENT
    Route::get('admin/blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('admin/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('admin/blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('admin/blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('admin/blog/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('admin/blog/{id}', [BlogController::class, 'destroy'])->name('admin.blog.delete');
    Route::get('admin/blog/{id}', [BlogController::class, 'show'])->name('admin.blog.show');

});


// Social OAuth
Route::get('auth/google', [UserSocialAuthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get('auth/google/callback', [UserSocialAuthController::class, 'handleGoogleCallback'])->name('oauth.google.callback');

// Password reset with code via email
Route::get('password/forgot', [UserSetPasswordController::class, 'showRequest'])->name('password.request');
Route::post('password/forgot', [UserSetPasswordController::class, 'sendCode'])->name('password.forgot.post');
Route::get('password/verify', [UserSetPasswordController::class, 'showVerify'])->name('password.verify');
Route::post('password/verify', [UserSetPasswordController::class, 'verifyCode'])->name('password.verify.post');
Route::get('password/reset', [UserSetPasswordController::class, 'showReset'])->name('password.reset');
Route::post('password/reset', [UserSetPasswordController::class, 'reset'])->name('password.reset.post');

// API gọi chatbot

Route::post('/chatbot', [UserChatController::class, 'chat']);