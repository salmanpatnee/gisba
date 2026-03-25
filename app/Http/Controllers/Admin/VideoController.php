<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::query()->latest()->paginate(15);

        return view('admin.videos.index', compact('videos'));
    }

    public function create(): View
    {
        return view('admin.videos.create');
    }

    public function store(StoreVideoRequest $request): RedirectResponse
    {
        $file = $request->file('video');
        $path = $file->store('videos', 'public');

        Video::create([
            'title' => $request->validated('title'),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video uploaded successfully.');
    }

    public function edit(Video $video): View
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(UpdateVideoRequest $request, Video $video): RedirectResponse
    {
        $data = ['title' => $request->validated('title')];

        if ($request->hasFile('video')) {
            Storage::disk('public')->delete($video->path);

            $file = $request->file('video');
            $data['path'] = $file->store('videos', 'public');
            $data['mime_type'] = $file->getMimeType();
            $data['size'] = $file->getSize();
        }

        $video->update($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video): RedirectResponse
    {
        Storage::disk('public')->delete($video->path);
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted successfully.');
    }
}
