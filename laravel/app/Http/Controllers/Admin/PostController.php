<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form');
    }

    public function show(string $locale, string $slug)
    {
        app()->setLocale($locale);
        $post = Post::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $alternateUrls = collect(['tr', 'en', 'ar'])->mapWithKeys(function ($l) use ($post) {
            $prefix = \App\Services\RouteTranslator::slug('posts', $l);
            return [$l => url($l . '/' . $prefix . '/' . $post->getTranslation('slug', $l))];
        })->toArray();

        view()->share('alternateUrls', $alternateUrls);

        return view('site.posts.show', compact('post', 'locale'));
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

        Post::create([
            'title' => ['tr' => $request->title_tr, 'en' => $request->title_en, 'ar' => $request->title_ar],
            'content' => ['tr' => $request->content_tr, 'en' => $request->content_en, 'ar' => $request->content_ar],
            'meta_title' => ['tr' => $request->meta_title_tr, 'en' => $request->meta_title_en, 'ar' => $request->meta_title_ar],
            'meta_description' => ['tr' => $request->meta_description_tr, 'en' => $request->meta_description_en, 'ar' => $request->meta_description_ar],
            'slug' => Str::slug($request->title_en),
            'is_active' => $request->boolean('is_active', true),
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Blog yazisi eklendi');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
        ]);

        $post->update([
            'title' => ['tr' => $request->title_tr, 'en' => $request->title_en, 'ar' => $request->title_ar],
            'content' => ['tr' => $request->content_tr, 'en' => $request->content_en, 'ar' => $request->content_ar],
            'meta_title' => ['tr' => $request->meta_title_tr, 'en' => $request->meta_title_en, 'ar' => $request->meta_title_ar],
            'meta_description' => ['tr' => $request->meta_description_tr, 'en' => $request->meta_description_en, 'ar' => $request->meta_description_ar],
            'slug' => Str::slug($request->title_en),
            'is_active' => $request->boolean('is_active', true),
            'published_at' => $request->published_at ?? $post->published_at,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Blog yazisi guncellendi');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Blog yazisi silindi');
    }
}
