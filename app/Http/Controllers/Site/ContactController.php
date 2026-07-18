<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(string $locale)
    {
        app()->setLocale($locale);
        return view('site.contact', compact('locale'));
    }

    public function store(Request $request, string $locale)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'message' => $request->message,
            'locale' => $locale,
        ]);

        return back()->with('success', 'Mesajiniz alindi');
    }
}
