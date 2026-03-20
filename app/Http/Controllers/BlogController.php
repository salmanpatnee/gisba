<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()
            ->latest()
            ->paginate(9);

        return view('pages.blog', compact('posts'));
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
