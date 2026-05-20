<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePmpPostRequest;
use App\Http\Requests\UpdatePmpPostRequest;
use App\Models\PmpCategory;
use App\Models\PmpPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PmpController extends Controller
{
    public function index(): View
    {
        $posts = PmpPost::query()->with('category')->latest()->paginate(15);

        return view('admin.pmp.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = PmpCategory::query()->latest()->get();

        return view('admin.pmp.create', compact('categories'));
    }

    public function store(StorePmpPostRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['featured_image', 'attachments']);
        $data['slug'] = Str::slug($request->title);
        $data['author'] = 'GISBA Editorial Team';

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('pmp', 'public');
        }

        $post = PmpPost::create($data);

        $this->storeAttachments($post, $request->file('attachments', []));

        return redirect()->route('admin.pmp.index')
            ->with('success', 'PMP post created successfully.');
    }

    public function edit(PmpPost $pmp): View
    {
        $categories = PmpCategory::query()->latest()->get();
        $pmp->load('attachments');

        return view('admin.pmp.edit', compact('pmp', 'categories'));
    }

    public function update(UpdatePmpPostRequest $request, PmpPost $pmp): RedirectResponse
    {
        $data = $request->safe()->except(['featured_image', 'attachments', 'delete_attachments']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            if ($pmp->featured_image && ! str_starts_with($pmp->featured_image, 'http')) {
                Storage::disk('public')->delete($pmp->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('pmp', 'public');
        }

        $pmp->update($data);

        foreach ($request->input('delete_attachments', []) as $attachmentId) {
            $attachment = $pmp->attachments()->find($attachmentId);
            if ($attachment) {
                Storage::disk('public')->delete($attachment->path);
                $attachment->delete();
            }
        }

        $this->storeAttachments($pmp, $request->file('attachments', []));

        return redirect()->route('admin.pmp.index')
            ->with('success', 'PMP post updated successfully.');
    }

    public function destroy(PmpPost $pmp): RedirectResponse
    {
        if ($pmp->featured_image && ! str_starts_with($pmp->featured_image, 'http')) {
            Storage::disk('public')->delete($pmp->featured_image);
        }

        foreach ($pmp->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->path);
        }

        $pmp->delete();

        return redirect()->route('admin.pmp.index')
            ->with('success', 'PMP post deleted successfully.');
    }

    /** @param array<UploadedFile> $files */
    private function storeAttachments(PmpPost $post, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('pmp/attachments', 'public');

            $post->attachments()->create([
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }
    }
}
