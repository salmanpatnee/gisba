<?php

namespace App\Http\Controllers;

use App\Enums\ResourceType;
use App\Models\Chapter;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ChapterResourceController extends Controller
{
    public function tutorials(Chapter $chapter): View
    {
        $chapter->load(['resources' => fn ($q) => $q->where('resource_type', ResourceType::Tutorial)]);

        return view('pages.members.chapters.tutorials', compact('chapter'));
    }

    public function takeaways(Chapter $chapter): View
    {
        $chapter->load(['resources' => fn ($q) => $q->where('resource_type', ResourceType::Takeaway)]);

        return view('pages.members.chapters.takeaways', compact('chapter'));
    }

    public function domainSummary(Chapter $chapter): View
    {
        $chapter->load(['resources' => fn ($q) => $q->where('resource_type', ResourceType::DomainSummary)]);

        return view('pages.members.chapters.domain-summary', compact('chapter'));
    }

    public function stream(Resource $resource): BinaryFileResponse
    {
        if ($resource->resource_type !== ResourceType::Tutorial) {
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
