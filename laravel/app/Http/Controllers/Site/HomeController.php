<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request, string $locale)
    {
        app()->setLocale($locale);
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        $posts = Post::where('is_active', true)->orderByDesc('published_at')->take(3)->get();
        return view('site.home', compact('categories', 'posts', 'locale'));
    }
}
