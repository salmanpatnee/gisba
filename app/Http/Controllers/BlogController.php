<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $categorizedPosts = BlogPost::query()
            ->latest()
            ->get()
            ->groupBy(fn (BlogPost $post): string => $post->category->value)
            ->filter(fn ($posts): bool => $posts->isNotEmpty());

        return view('pages.blog', compact('categorizedPosts'));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $related = BlogPost::query()
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.blog-show', compact('post', 'related'));
    }
}
