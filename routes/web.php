<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController as SiteProductController;
use App\Http\Controllers\Site\PostController as SitePostController;
use App\Http\Controllers\Site\ContactController;

// ── Site Routes ──────────────────────────────────────────────
Route::prefix('{locale}')
    ->where(['locale' => 'tr|en|ar'])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/urunler', [SiteProductController::class, 'index'])->name('products.index');
        Route::get('/urunler/{slug}', [SiteProductController::class, 'show'])->name('products.show');
        Route::get('/blog', [SitePostController::class, 'index'])->name('posts.index');
        Route::get('/blog/{slug}', [SitePostController::class, 'show'])->name('posts.show');
        Route::get('/iletisim', [ContactController::class, 'index'])->name('contact.index');
        Route::post('/iletisim', [ContactController::class, 'store'])->name('contact.store');
    });

Route::redirect('/', '/tr');

// ── Admin Routes ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('posts', PostController::class);
        Route::resource('pages', PageController::class);
        Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
        Route::patch('messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
    });
});
