<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function index(): View
    {
        $chapters = Chapter::query()->orderBy('sort_order')->orderBy('title')->paginate(20);

        return view('admin.chapters.index', compact('chapters'));
    }

    public function create(): View
    {
        $chapter = null;

        return view('admin.chapters.create', compact('chapter'));
    }

    public function store(StoreChapterRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image_path');
        $data['slug'] = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['title']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('chapters/images', 'public');
        }

        Chapter::create($data);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter created successfully.');
    }

    public function show(Chapter $chapter): View
    {
        $chapter->load('resources');

        return view('admin.chapters.show', compact('chapter'));
    }

    public function edit(Chapter $chapter): View
    {
        return view('admin.chapters.edit', compact('chapter'));
    }

    public function update(UpdateChapterRequest $request, Chapter $chapter): RedirectResponse
    {
        $data = $request->safe()->except('image_path');
        $data['slug'] = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['title']);

        if ($request->hasFile('image_path')) {
            if ($chapter->image_path && ! str_starts_with($chapter->image_path, 'http')) {
                Storage::disk('public')->delete($chapter->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('chapters/images', 'public');
        }

        $chapter->update($data);

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter updated successfully.');
    }

    public function destroy(Chapter $chapter): RedirectResponse
    {
        if ($chapter->resources()->count() > 0) {
            return redirect()->route('admin.chapters.index')
                ->with('error', 'Cannot delete chapter — it has resources attached. Remove resources first.');
        }

        if ($chapter->image_path && ! str_starts_with($chapter->image_path, 'http')) {
            Storage::disk('public')->delete($chapter->image_path);
        }

        $chapter->delete();

        return redirect()->route('admin.chapters.index')
            ->with('success', 'Chapter deleted successfully.');
    }
}
