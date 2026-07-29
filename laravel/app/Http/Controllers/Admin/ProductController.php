<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderByDesc('created_at')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_tr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        Product::create([
            'name' => ['tr' => $request->name_tr, 'en' => $request->name_en, 'ar' => $request->name_ar],
            'description' => ['tr' => $request->description_tr, 'en' => $request->description_en, 'ar' => $request->description_ar],
            'category_id' => $request -> cat_id,
            'slug' => Str::slug($request->name_en),
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Ürün eklendi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $locale, string $slug)
    {
        app()->setLocale($locale);
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $alternateUrls = collect(['tr', 'en', 'ar'])->mapWithKeys(function ($l) use ($product) {
            $prefix = \App\Services\RouteTranslator::slug('products', $l);
            return [$l => url($l . '/' . $prefix . '/' . $product->getTranslation('slug', $l))];
        })->toArray();

        view()->share('alternateUrls', $alternateUrls);

        return view('site.products.show', compact('product', 'locale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
