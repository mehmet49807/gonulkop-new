<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DiscoveryController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SuperLikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->middleware('throttle:login')->name('login.store');
    Route::get('/register', [AuthController::class, 'createRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
    Route::get('/api/feed', [FeedController::class, 'index'])->name('feed.api');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/discover', [DiscoveryController::class, 'index'])->name('discover.index');
    Route::get('/matches', [DiscoveryController::class, 'matches'])->name('matches.index');

    Route::get('/messages', [ChatController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [ChatController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [ChatController::class, 'store'])->name('messages.store');

    Route::post('/super-like/{user}', [SuperLikeController::class, 'store'])->name('super-like.store');
    Route::get('/super-like/count', [SuperLikeController::class, 'count'])->name('super-like.count');

    Route::get('/premium', [PremiumController::class, 'index'])->name('premium.index');
    Route::post('/premium/{package}', [PremiumController::class, 'purchase'])->name('premium.purchase');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profiles.show');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::delete('/settings/account', [SettingsController::class, 'destroy'])->name('settings.destroy');
});

// Admin giriş ekranı ve session tabanlı yönetim rotaları.
Route::get('/admin/login', [AdminController::class, 'createLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'storeLogin'])
    ->middleware('throttle:login')
    ->name('admin.login.store');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::middleware('admin')->group(function (): void {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{id}', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
    Route::patch('/admin/posts/{id}/status', [AdminController::class, 'togglePostStatus'])->name('admin.posts.status');
    Route::delete('/admin/posts/{id}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');

    Route::get('/admin/stories', [AdminController::class, 'stories'])->name('admin.stories');
    Route::delete('/admin/stories/{id}', [AdminController::class, 'destroyStory'])->name('admin.stories.destroy');

    Route::get('/admin/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::delete('/admin/messages/{id}', [AdminController::class, 'destroyMessage'])->name('admin.messages.destroy');

    Route::get('/admin/super-likes', [AdminController::class, 'superLikes'])->name('admin.super-likes');
    Route::delete('/admin/super-likes/{id}', [AdminController::class, 'destroySuperLike'])->name('admin.super-likes.destroy');

    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});
