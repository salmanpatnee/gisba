<?php

namespace App\Http\Controllers;

use App\Models\MemberPost;
use Illuminate\View\View;

class MembersController extends Controller
{
    public function paywall(): View
    {
        return view('pages.members');
    }

    public function index(): View
    {
        $posts = MemberPost::query()->latest()->get();

        return view('pages.members-library', compact('posts'));
    }

    public function show(string $slug): View
    {
        $post = MemberPost::query()->where('slug', $slug)->firstOrFail();

        return view('pages.members-show', compact('post'));
    }
}
