<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderByDesc('created_at')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Mesaj silindi');
    }

    public function markAsRead(Message $message)
    {
        $message->update(['is_read' => true]);
        return back();
    }
}
