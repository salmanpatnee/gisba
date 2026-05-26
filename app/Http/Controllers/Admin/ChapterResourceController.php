<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ChapterResourceController extends Controller
{
    public function create(Chapter $chapter): View
    {
        return view('admin.chapters.resources.create', compact('chapter'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'chapter_id' => ['required', 'integer', 'exists:chapters,id'],
            'tutorial' => ['nullable', 'file', 'mimes:mp4', 'max:512000'],
            'quiz' => ['nullable', 'file', 'mimes:mp4', 'max:512000'],
            'takeaway' => ['nullable', 'file', 'mimes:mp4', 'max:512000'],
            'domain_summary' => ['nullable', 'file', 'mimes:mp4', 'max:512000'],
        ]);

        $chapter = Chapter::findOrFail($request->chapter_id);

        $uploads = [
            'tutorial' => 'tutorial',
            'quiz' => 'quizzes',
            'takeaway' => 'takeaway',
            'domain_summary' => 'domain_summary',
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
