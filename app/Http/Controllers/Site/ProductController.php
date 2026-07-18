<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(string $locale)
    {
        app()->setLocale($locale);
        $categories = Category::with('products')->where('is_active', true)->orderBy('order')->get();
        return view('site.products.index', compact('categories', 'locale'));
    }

    public function show(string $locale, string $slug)
    {
        app()->setLocale($locale);
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('site.products.show', compact('product', 'locale'));
    }
}
