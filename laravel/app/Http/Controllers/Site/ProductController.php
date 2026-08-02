<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ?string $categorySlug = null)
    {
        $locale = $request->route('locale');
        app()->setLocale($locale);

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->orderBy('order')
            ->get();

        $activeCategory = $categorySlug
            ? $categories->first(fn($cat) => $cat->slug === $categorySlug)
            : $categories->first();
            
            
        // dd($activeCategory);

        abort_unless($activeCategory, 404);

        $sort = $request->query('sort', 'newest');
        $query = Product::where('category_id', $activeCategory->id)
            ->where('is_active', true);

        match ($sort) {
            'capacity-desc' => $query->orderByDesc('capacity_value'),
            'capacity-asc' => $query->orderBy('capacity_value'),
            'name' => $query->orderBy('name'),
            default => $query->latest(),
        };

        $products = $query->get();

        $firstCategoryId = $categories->first()->id;

        $categories = $categories->map(function ($cat) use ($activeCategory, $locale, $firstCategoryId) {
            $cat->active = $cat->id === $activeCategory->id;
            $cat->url = $cat->id === $firstCategoryId
                ? route("{$locale}.products.index")
                : route("{$locale}.products.category", ['categorySlug' => $cat->slug]);
            $cat->count = $cat->products_count;
            return $cat;
        });

        return view('site.products.index', compact('categories', 'products', 'sort', 'locale', 'activeCategory'));
    }

    public function show(Request $request, string $slug)
    {
        $locale = $request->route('locale');
        app()->setLocale($locale);

        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('site.products.show', compact('product', 'locale'));
    }
}