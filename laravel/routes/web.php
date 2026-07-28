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
$slugs = config('route-translations');

foreach (['tr', 'en', 'ar'] as $locale) {
    Route::prefix($locale)
        ->name("{$locale}.")
        ->group(function () use ($locale, $slugs) {
            Route::get('/', [HomeController::class, 'index'])->name('home')->defaults('locale', $locale);
            Route::get('/' . $slugs['about'][$locale], [HomeController::class, 'about'])->name('about')->defaults('locale', $locale);
            Route::get('/' . $slugs['videos'][$locale], [HomeController::class, 'videos'])->name('videos')->defaults('locale', $locale);

            Route::get('/' . $slugs['products'][$locale], [SiteProductController::class, 'index'])->name('products.index')->defaults('locale', $locale);
            Route::get('/' . $slugs['products'][$locale] . '/{slug}', [SiteProductController::class, 'show'])->name('products.show')->defaults('locale', $locale);

            Route::get('/' . $slugs['posts'][$locale], [SitePostController::class, 'index'])->name('posts.index')->defaults('locale', $locale);
            Route::get('/' . $slugs['posts'][$locale] . '/{slug}', [SitePostController::class, 'show'])->name('posts.show')->defaults('locale', $locale);

            Route::get('/' . $slugs['contact'][$locale], [ContactController::class, 'index'])->name('contact.index')->defaults('locale', $locale);
        });
}

// POST — tek route yeterli, dile göre tekrar etmesine gerek yok
Route::post('/{locale}/' . 'iletisim-gonder', [ContactController::class, 'store'])
    ->where('locale', 'tr|en|ar')
    ->name('contact.store');

Route::redirect('/', '/tr');

// ── Admin Routes ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
