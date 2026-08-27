<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriscPostRequest;
use App\Http\Requests\UpdateCriscPostRequest;
use App\Models\CriscCategory;
use App\Models\CriscPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CriscController extends Controller
{
    public function index(): View
    {
        $posts = CriscPost::query()->with('category')->latest()->paginate(15);

        return view('admin.crisc.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = CriscCategory::query()->latest()->get();

        return view('admin.crisc.create', compact('categories'));
    }

    public function store(StoreCriscPostRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['featured_image', 'attachments']);
        $data['slug'] = Str::slug($request->title);
        $data['author'] = 'GISBA Editorial Team';

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('crisc', 'public');
        }

        $post = CriscPost::create($data);

        $this->storeAttachments($post, $request->file('attachments', []));

        return redirect()->route('admin.crisc.index')
            ->with('success', 'CRISC post created successfully.');
    }

    public function edit(CriscPost $crisc): View
    {
        $categories = CriscCategory::query()->latest()->get();
        $crisc->load('attachments');

        return view('admin.crisc.edit', compact('crisc', 'categories'));
    }

    public function update(UpdateCriscPostRequest $request, CriscPost $crisc): RedirectResponse
    {
        $data = $request->safe()->except(['featured_image', 'attachments', 'delete_attachments']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            if ($crisc->featured_image && ! str_starts_with($crisc->featured_image, 'http')) {
                Storage::disk('public')->delete($crisc->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('crisc', 'public');
        }

        $crisc->update($data);

        foreach ($request->input('delete_attachments', []) as $attachmentId) {
            $attachment = $crisc->attachments()->find($attachmentId);
            if ($attachment) {
                Storage::disk('public')->delete($attachment->path);
                $attachment->delete();
            }
        }

        $this->storeAttachments($crisc, $request->file('attachments', []));

        return redirect()->route('admin.crisc.index')
            ->with('success', 'CRISC post updated successfully.');
    }

    public function destroy(CriscPost $crisc): RedirectResponse
    {
        if ($crisc->featured_image && ! str_starts_with($crisc->featured_image, 'http')) {
            Storage::disk('public')->delete($crisc->featured_image);
        }

        foreach ($crisc->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->path);
        }

        $crisc->delete();

        return redirect()->route('admin.crisc.index')
            ->with('success', 'CRISC post deleted successfully.');
    }

    /** @param array<UploadedFile> $files */
    private function storeAttachments(CriscPost $post, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('crisc/attachments', 'public');

            $post->attachments()->create([
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }
    }
}
