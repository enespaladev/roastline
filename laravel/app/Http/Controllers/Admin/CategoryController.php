<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_tr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'slug_tr' => 'required|string|max:255',
            'slug_en' => 'required|string|max:255',
            'slug_ar' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => ['tr' => $request->name_tr, 'en' => $request->name_en, 'ar' => $request->name_ar],
            'description' => ['tr' => $request->description_tr, 'en' => $request->description_en, 'ar' => $request->description_ar],
            'slug' => [
                'tr' => Str::slug($request->slug_tr),
                'en' => Str::slug($request->slug_en),
                'ar' => Str::slug($request->slug_ar),
            ],
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori eklendi');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_tr' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'slug_tr' => 'required|string|max:255',
            'slug_en' => 'required|string|max:255',
            'slug_ar' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => ['tr' => $request->name_tr, 'en' => $request->name_en, 'ar' => $request->name_ar],
            'description' => ['tr' => $request->description_tr, 'en' => $request->description_en, 'ar' => $request->description_ar],
            'slug' => [
                'tr' => Str::slug($request->slug_tr),
                'en' => Str::slug($request->slug_en),
                'ar' => Str::slug($request->slug_ar),
            ],
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori guncellendi');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori silindi');
    }
}
