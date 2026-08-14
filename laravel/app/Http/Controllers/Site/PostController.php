<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(string $locale)
    {
        app()->setLocale($locale);
        $posts = Post::where('is_active', true)->orderByDesc('published_at')->paginate(12);
        // dd($posts);
        return view('site.posts.index', compact('posts', 'locale'));
    }

    // public function show(string $locale, string $slug)
    // {
    //     app()->setLocale($locale);

    //     $post = Post::where("slug->{$locale}", $slug)
    //         ->where('is_active', true)
    //         ->firstOrFail();

    //     return view('site.posts.show', compact('post', 'locale'));
    // }

    public function show(Request $request, string $slug)
    {
        $locale = $request->route('locale');

        app()->setLocale($locale);

        $post = Post::where("slug->{$locale}", $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $popularPosts = Post::query()
            ->where('id', '!=', $post->id)
            ->where('is_active', true)
            ->latest()
            ->limit(5)
            ->get();

        $labels = Tag::query()->latest()->limit(15)->get();


        return view('site.posts.show', compact('post', 'locale', 'popularPosts', 'labels'));
    }
}
