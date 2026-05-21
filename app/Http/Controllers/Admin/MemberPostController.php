<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberPostRequest;
use App\Http\Requests\UpdateMemberPostRequest;
use App\Models\MemberPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MemberPostController extends Controller
{
    public function index(): View
    {
        $posts = MemberPost::query()->latest()->paginate(15);

        return view('admin.member-posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.member-posts.create');
    }

    public function store(StoreMemberPostRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('featured_image');
        $data['slug'] = Str::slug($request->title);
        $data['author'] = 'GISBA Editorial Team';

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('members', 'public');
        }

        MemberPost::create($data);

        return redirect()->route('admin.member-posts.index')
            ->with('success', 'Member post created successfully.');
    }

    public function edit(MemberPost $memberPost): View
    {
        return view('admin.member-posts.edit', ['post' => $memberPost]);
    }

    public function update(UpdateMemberPostRequest $request, MemberPost $memberPost): RedirectResponse
    {
        $data = $request->safe()->except('featured_image');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('featured_image')) {
            if ($memberPost->featured_image && ! str_starts_with($memberPost->featured_image, 'http')) {
                Storage::disk('public')->delete($memberPost->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('members', 'public');
        }

        $memberPost->update($data);

        return redirect()->route('admin.member-posts.index')
            ->with('success', 'Member post updated successfully.');
    }

    public function destroy(MemberPost $memberPost): RedirectResponse
    {
        if ($memberPost->featured_image && ! str_starts_with($memberPost->featured_image, 'http')) {
            Storage::disk('public')->delete($memberPost->featured_image);
        }

        $memberPost->delete();

        return redirect()->route('admin.member-posts.index')
            ->with('success', 'Member post deleted successfully.');
    }
}
