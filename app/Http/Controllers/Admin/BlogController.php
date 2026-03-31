<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()->with('category')->latest()->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::query()->latest()->get();

        return view('admin.blog.create', compact('categories'));
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['featured_image', 'attachments']);
        $data['slug'] = Str::slug($request->title);
        $data['author'] = 'GISBA Editorial Team';

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $post = BlogPost::create($data);

        $this->storeAttachments($post, $request->file('attachments', []));

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog): View
    {
        $categories = Category::query()->latest()->get();
        $blog->load('attachments');

        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blog): RedirectResponse
    {
        $data = $request->safe()->except(['featured_image', 'attachments', 'delete_attachments']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image && ! str_starts_with($blog->featured_image, 'http')) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $blog->update($data);

        foreach ($request->input('delete_attachments', []) as $attachmentId) {
            $attachment = $blog->attachments()->find($attachmentId);
            if ($attachment) {
                Storage::disk('public')->delete($attachment->path);
                $attachment->delete();
            }
        }

        $this->storeAttachments($blog, $request->file('attachments', []));

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        if ($blog->featured_image && ! str_starts_with($blog->featured_image, 'http')) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        foreach ($blog->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->path);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    /** @param array<UploadedFile> $files */
    private function storeAttachments(BlogPost $post, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('blog/attachments', 'public');

            $post->attachments()->create([
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }
    }
}
