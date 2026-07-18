<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Post;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'posts' => Post::count(),
            'messages' => Message::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
