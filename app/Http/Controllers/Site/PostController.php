<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index(string $locale)
    {
        app()->setLocale($locale);
        $posts = Post::where('is_active', true)->orderByDesc('published_at')->paginate(12);
        return view('site.posts.index', compact('posts', 'locale'));
    }

    public function show(string $locale, string $slug)
    {
        app()->setLocale($locale);
        $post = Post::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('site.posts.show', compact('post', 'locale'));
    }
}
