<?php

namespace App\Http\Controllers;

use App\Enums\ResourceType;
use App\Models\Chapter;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ChapterResourceController extends Controller
{
    public function tutorials(Chapter $chapter): View
    {
        $this->loadResourcesForType($chapter, ResourceType::Tutorial);

        return view('pages.members.chapters.tutorials', compact('chapter'));
    }

    public function takeaways(Chapter $chapter): View
    {
        $this->loadResourcesForType($chapter, ResourceType::Takeaway);

        return view('pages.members.chapters.takeaways', compact('chapter'));
    }

    public function domainSummary(Chapter $chapter): View
    {
        $this->loadResourcesForType($chapter, ResourceType::DomainSummary);

        return view('pages.members.chapters.domain-summary', compact('chapter'));
    }

    public function quizzes(Chapter $chapter): View
    {
        $this->loadResourcesForType($chapter, ResourceType::Quizzes);

        return view('pages.members.chapters.quizzes', compact('chapter'));
    }

    public function markComplete(Resource $resource): JsonResponse
    {
        auth()->user()->watchedResources()->syncWithoutDetaching([
            $resource->id => ['completed_at' => now()],
        ]);

        return response()->json(['watched' => true]);
    }

    /**
     * Load a chapter's resources for a single type, eager-loading the current
     * member's watched state so views can call isWatchedBy() without N+1 queries.
     */
    private function loadResourcesForType(Chapter $chapter, ResourceType $type): void
    {
        $userId = auth()->id();

        $chapter->load(['resources' => fn ($q) => $q
            ->where('resource_type', $type)
            ->with(['watchers' => fn ($w) => $w->where('users.id', $userId)]),
        ]);
    }

    public function stream(Resource $resource): BinaryFileResponse
    {
        if (! in_array($resource->resource_type, [ResourceType::Tutorial, ResourceType::Quizzes, ResourceType::Takeaway, ResourceType::DomainSummary])) {
            abort(403);
        }

        $disk = Storage::disk('public');
        abort_unless($disk->exists($resource->file_path), 404);

        return response()->file($disk->path($resource->file_path), [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'inline',
            'Cache-Control' => 'no-store',
        ]);
    }

    public function view(Resource $resource): BinaryFileResponse
    {
        $disk = Storage::disk('public');
        abort_unless($disk->exists($resource->file_path), 404);

        return response()->file($disk->path($resource->file_path), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline',
            'Cache-Control' => 'no-store',
        ]);
    }

    public function download(Resource $resource): Response
    {
        if (! Storage::disk('public')->exists($resource->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($resource->file_path, $resource->file_name);
    }

    public function destroy(Resource $resource): RedirectResponse
    {
        Storage::disk('public')->delete($resource->file_path);
        $resource->delete();

        return redirect()->back()->with('success', 'Resource deleted successfully.');
    }
}
