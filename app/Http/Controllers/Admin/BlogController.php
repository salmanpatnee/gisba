<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()->latest()->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::options();

        return view('admin.blog.create', compact('categories'));
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('featured_image');
        $data['slug'] = Str::slug($request->title);
        $data['author'] = 'GISBA Editorial Team';

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog): View
    {
        $categories = Category::options();

        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blog): RedirectResponse
    {
        $data = $request->safe()->except('featured_image');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image && ! str_starts_with($blog->featured_image, 'http')) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        if ($blog->featured_image && ! str_starts_with($blog->featured_image, 'http')) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}
