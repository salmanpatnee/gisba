<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterResourceRequest;
use App\Models\Chapter;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ChapterResourceController extends Controller
{
    public function create(Chapter $chapter): View
    {
        return view('admin.chapters.resources.create', compact('chapter'));
    }

    public function store(StoreChapterResourceRequest $request): RedirectResponse
    {
        $chapter = Chapter::findOrFail($request->validated('chapter_id'));

        $uploads = [
            'tutorial' => 'tutorial',
            'quiz' => 'quizzes',
        ];

        foreach ($uploads as $input => $type) {
            if ($request->hasFile($input)) {
                $file = $request->file($input);
                $path = $file->store('chapters/resources', 'public');

                $chapter->resources()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'resource_type' => $type,
                ]);
            }
        }

        if ($request->has('additional_resources')) {
            $chapter->update(['additional_resources' => $request->validated('additional_resources')]);
        }

        return redirect()->route('admin.chapters.show', $chapter)
            ->with('success', 'Resources uploaded successfully.');
    }

    public function destroy(Resource $resource): RedirectResponse
    {
        $chapter = $resource->resourceable;

        Storage::disk('public')->delete($resource->file_path);
        $resource->delete();

        return redirect()->route('admin.chapters.show', $chapter)
            ->with('success', 'Resource deleted successfully.');
    }
}
