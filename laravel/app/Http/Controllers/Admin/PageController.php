<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
        ]);

        Page::create([
            'title' => ['tr' => $request->title_tr, 'en' => $request->title_en, 'ar' => $request->title_ar],
            'content' => ['tr' => $request->content_tr, 'en' => $request->content_en, 'ar' => $request->content_ar],
            'meta_title' => ['tr' => $request->meta_title_tr, 'en' => $request->meta_title_en, 'ar' => $request->meta_title_ar],
            'meta_description' => ['tr' => $request->meta_description_tr, 'en' => $request->meta_description_en, 'ar' => $request->meta_description_ar],
            'slug' => Str::slug($request->title_en),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Sayfa eklendi');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
        ]);

        $page->update([
            'title' => ['tr' => $request->title_tr, 'en' => $request->title_en, 'ar' => $request->title_ar],
            'content' => ['tr' => $request->content_tr, 'en' => $request->content_en, 'ar' => $request->content_ar],
            'meta_title' => ['tr' => $request->meta_title_tr, 'en' => $request->meta_title_en, 'ar' => $request->meta_title_ar],
            'meta_description' => ['tr' => $request->meta_description_tr, 'en' => $request->meta_description_en, 'ar' => $request->meta_description_ar],
            'slug' => Str::slug($request->title_en),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Sayfa guncellendi');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Sayfa silindi');
    }
}
