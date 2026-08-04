<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::withoutGlobalScope('order')
            ->orderBy('order')
            ->paginate(15);

        return view('admin.videos.index', compact('videos'));
    }

    public function create(): View
    {
        return view('admin.videos.create');
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        Video::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'youtube_id' => $request->input('youtube_id'),
            'duration' => $request->input('duration'),
            'order' => $request->input('order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video başarıyla eklendi.');
    }

    public function edit(Video $video): View
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        $video->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'youtube_id' => $request->input('youtube_id'),
            'duration' => $request->input('duration'),
            'order' => $request->input('order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video başarıyla güncellendi.');
    }

    public function destroy(Video $video): RedirectResponse
    {
        $video->delete();

        return redirect()
            ->route('admin.videos.index')
            ->with('success', 'Video silindi.');
    }
}
