<?php

namespace App\Http\Controllers;

use App\Models\CriscPost;
use Illuminate\View\View;

class CriscController extends Controller
{
    public function show(string $slug): View
    {
        $post = CriscPost::query()
            ->with('attachments')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = CriscPost::query()
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.crisc-show', compact('post', 'related'));
    }
}
