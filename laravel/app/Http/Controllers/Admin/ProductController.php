<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
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
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
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

            'capacity_value' => 'required|integer|min:0',

            'capacity_tr' => 'nullable|string|max:255',
            'capacity_en' => 'nullable|string|max:255',
            'capacity_ar' => 'nullable|string|max:255',

            'power_tr' => 'nullable|string|max:255',
            'power_en' => 'nullable|string|max:255',
            'power_ar' => 'nullable|string|max:255',

            'badge_tr' => 'nullable|string|max:100',
            'badge_en' => 'nullable|string|max:100',
            'badge_ar' => 'nullable|string|max:100',

            'roasted_name_tr' => 'nullable|array',
            'roasted_name_en' => 'nullable|array',
            'roasted_name_ar' => 'nullable|array',
            'roasted_kg'      => 'nullable|array',

            'diesel_min' => 'nullable|numeric',
            'diesel_max' => 'nullable|numeric',
            'diesel_avg' => 'nullable|numeric',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Kavrulan ürünler — TR/EN/AR aynı index'te satır satır eşleşiyor
        $roastedTr = [];
        $roastedEn = [];
        $roastedAr = [];

        $namesTr = $request->roasted_name_tr ?? [];
        $namesEn = $request->roasted_name_en ?? [];
        $namesAr = $request->roasted_name_ar ?? [];
        $kgs     = $request->roasted_kg ?? [];

        foreach ($namesTr as $index => $nameTr) {
            $kg = $kgs[$index] ?? null;

            // tamamen boş satırı atla
            if (blank($nameTr) && blank($namesEn[$index] ?? null) && blank($kg)) {
                continue;
            }

            $roastedTr[] = ['name' => $nameTr, 'kg' => $kg];
            $roastedEn[] = ['name' => $namesEn[$index] ?? '', 'kg' => $kg];
            $roastedAr[] = ['name' => $namesAr[$index] ?? '', 'kg' => $kg];
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => ['tr' => $request->name_tr, 'en' => $request->name_en, 'ar' => $request->name_ar],
            'description' => ['tr' => $request->description_tr, 'en' => $request->description_en, 'ar' => $request->description_ar],

            'badge' => ['tr' => $request->badge_tr, 'en' => $request->badge_en, 'ar' => $request->badge_ar],
            'capacity' => ['tr' => $request->capacity_tr, 'en' => $request->capacity_en, 'ar' => $request->capacity_ar],
            'capacity_value' => $request->capacity_value,
            'power' => ['tr' => $request->power_tr, 'en' => $request->power_en, 'ar' => $request->power_ar],

            'roasted_products' => ['tr' => $roastedTr, 'en' => $roastedEn, 'ar' => $roastedAr],

            'energy_specs' => [
                'diesel' => [
                    'min' => $request->diesel_min,
                    'max' => $request->diesel_max,
                    'avg' => $request->diesel_avg,
                ],
            ],

            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name_en),
            'order' => $request->order ?? 0,
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Ürün eklendi');
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
        // dd($id);
        $product = Product::findOrFail($id);
        $categories = Category::all();
        // dd($product);

        // TR/EN/AR kavrulan ürün listelerini tek bir array'de birleştiriyoruz
        $roastedTr = $product->getTranslation('roasted_products', 'tr') ?? [];
        $roastedEn = $product->getTranslation('roasted_products', 'en') ?? [];
        $roastedAr = $product->getTranslation('roasted_products', 'ar') ?? [];

        $roastedItems = [];
        foreach ($roastedTr as $index => $item) {
            $roastedItems[] = [
                'name_tr' => $item['name'] ?? '',
                'name_en' => $roastedEn[$index]['name'] ?? '',
                'name_ar' => $roastedAr[$index]['name'] ?? '',
                'kg'      => $item['kg'] ?? '',
            ];
        }

        return view('admin.products.form', compact('product', 'categories', 'roastedItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name_tr'           => 'required|string|max:255',
            'name_en'           => 'required|string|max:255',
            'name_ar'           => 'required|string|max:255',
            'description_tr'    => 'nullable|string',
            'description_en'    => 'nullable|string',
            'description_ar'    => 'nullable|string',
            'badge'             => 'nullable|string',
            'capacity'          => 'nullable|string',
            'capacity_value'    => 'nullable|integer',
            'power_tr'          => 'nullable|string',
            'power_en'          => 'nullable|string',
            'power_ar'          => 'nullable|string',
            'order'             => 'nullable|integer',
            'is_active'         => 'nullable|boolean',

            'roasted_name_tr'   => 'nullable|array',
            'roasted_name_en'   => 'nullable|array',
            'roasted_name_ar'   => 'nullable|array',
            'roasted_kg'        => 'nullable|array',

            'diesel_min'        => 'nullable|numeric',
            'diesel_max'        => 'nullable|numeric',
            'diesel_avg'        => 'nullable|numeric',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Kategori ve düz alanlar
        $product->category_id    = $validated['category_id'];
        $product->capacity_value = $validated['capacity_value'] ?? null;
        $product->order          = $validated['order'] ?? 0;
        $product->is_active      = $request->boolean('is_active');

        // Çevrilebilir (translatable) alanlar
        $product->setTranslation('name', 'tr', $validated['name_tr']);
        $product->setTranslation('name', 'en', $validated['name_en']);
        $product->setTranslation('name', 'ar', $validated['name_ar']);

        $product->setTranslation('description', 'tr', $validated['description_tr'] ?? '');
        $product->setTranslation('description', 'en', $validated['description_en'] ?? '');
        $product->setTranslation('description', 'ar', $validated['description_ar'] ?? '');

        $product->setTranslation('power', 'tr', $validated['power_tr'] ?? '');
        $product->setTranslation('power', 'en', $validated['power_en'] ?? '');
        $product->setTranslation('power', 'ar', $validated['power_ar'] ?? '');

        // capacity formda tek input olarak geliyor (dil ayrımı yok görünüyor), TR'ye yazıyoruz
        $product->setTranslation('capacity', 'tr', $validated['capacity'] ?? '');

        $product->badge = $validated['badge'] ?? null;

        // Kavrulan ürünler — TR/EN/AR aynı index'te satır satır eşleşiyor
        $roastedTr = [];
        $roastedEn = [];
        $roastedAr = [];

        $namesTr = $request->roasted_name_tr ?? [];
        $namesEn = $request->roasted_name_en ?? [];
        $namesAr = $request->roasted_name_ar ?? [];
        $kgs     = $request->roasted_kg ?? [];

        foreach ($namesTr as $index => $nameTr) {
            $kg = $kgs[$index] ?? null;

            // tamamen boş satırı atla
            if (blank($nameTr) && blank($namesEn[$index] ?? null) && blank($kg)) {
                continue;
            }

            $roastedTr[] = ['name' => $nameTr, 'kg' => $kg];
            $roastedEn[] = ['name' => $namesEn[$index] ?? '', 'kg' => $kg];
            $roastedAr[] = ['name' => $namesAr[$index] ?? '', 'kg' => $kg];
        }

        $product->setTranslation('roasted_products', 'tr', $roastedTr);
        $product->setTranslation('roasted_products', 'en', $roastedEn);
        $product->setTranslation('roasted_products', 'ar', $roastedAr);

        // Enerji özellikleri
        $product->energy_specs = [
            'diesel' => [
                'min' => $validated['diesel_min'] ?? null,
                'max' => $validated['diesel_max'] ?? null,
                'avg' => $validated['diesel_avg'] ?? null,
            ],
        ];

        if ($request->hasFile('image')) {
            // eski görseli sil (varsa)
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Ürün başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
