<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'slug_tr' => 'required|string|max:255',
            'slug_en' => 'nullable|string|max:255',
            'slug_ar' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = [
            'title' => ['tr' => $request->title_tr, 'en' => $request->title_en, 'ar' => $request->title_ar],
            'content' => ['tr' => $request->content_tr, 'en' => $request->content_en, 'ar' => $request->content_ar],
            'meta_title' => ['tr' => $request->meta_title_tr, 'en' => $request->meta_title_en, 'ar' => $request->meta_title_ar],
            'meta_description' => ['tr' => $request->meta_description_tr, 'en' => $request->meta_description_en, 'ar' => $request->meta_description_ar],
            'badge' => ['tr' => $request->badge_tr, 'en' => $request->badge_en, 'ar' => $request->badge_ar],
            'slug' => [
                'tr' => Str::slug($request->slug_tr ?: $request->title_tr),
                'en' => Str::slug($request->slug_en ?: $request->title_en ?: $request->slug_tr ?: $request->title_tr),
                'ar' => $request->slug_ar ?: ($request->slug_tr ?: $request->title_tr),
            ],
            'is_active' => $request->boolean('is_active', true),
            'published_at' => $request->published_at ?? now(),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Blog yazısı eklendi');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // dd($request->hasFile('image'), $request->file('image'));

        $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'slug_tr' => 'required|string|max:255',
            'slug_en' => 'nullable|string|max:255',
            'slug_ar' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = [
            'title' => ['tr' => $request->title_tr, 'en' => $request->title_en, 'ar' => $request->title_ar],
            'content' => ['tr' => $request->content_tr, 'en' => $request->content_en, 'ar' => $request->content_ar],
            'meta_title' => ['tr' => $request->meta_title_tr, 'en' => $request->meta_title_en, 'ar' => $request->meta_title_ar],
            'meta_description' => ['tr' => $request->meta_description_tr, 'en' => $request->meta_description_en, 'ar' => $request->meta_description_ar],
            'badge' => ['tr' => $request->badge_tr, 'en' => $request->badge_en, 'ar' => $request->badge_ar],
            'slug' => [
                'tr' => Str::slug($request->slug_tr ?: $request->title_tr),
                'en' => Str::slug($request->slug_en ?: $request->title_en ?: $request->slug_tr ?: $request->title_tr),
                'ar' => $request->slug_ar ?: ($request->slug_tr ?: $request->title_tr),
            ],
            'is_active' => $request->boolean('is_active', true),
            'published_at' => $request->published_at ?? $post->published_at,
        ];

        // Görseli kaldır
        if ($request->boolean('remove_image') && $post->image) {
            Storage::disk('public')->delete($post->image);
            $data['image'] = null;
        }

        // Yeni görsel yüklendi
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Blog yazısı güncellendi');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Blog yazisi silindi');
    }
}
