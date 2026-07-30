<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request, string $locale)
    {
        app()->setLocale($locale);

        $sort = $request->query('sort', 'newest');
        $query = Product::query();

        match ($sort) {
            'capacity-desc' => $query->orderByDesc('capacity_value'), // sayısal bir kolon önerilir
            'capacity-asc'  => $query->orderBy('capacity_value'),
            'name'          => $query->orderBy('name'), // dikkat: JSON translatable kolonda sıralama için raw SQL gerekebilir
            default         => $query->latest(),
        };

        // $products = Product::where('is_active', true)->get();
        $products = $query->get();

        // dd($products);

        $categories = Category::with('products')->where('is_active', true)->orderBy('order')->get();

        return view('site.products.index', compact('categories', 'products',  'sort', 'locale'));
    }

    public function show(string $locale, string $slug)
    {
        app()->setLocale($locale);
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('site.products.show', compact('product', 'locale'));
    }
}
