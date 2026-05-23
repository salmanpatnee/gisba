<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberAccessToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(): View
    {
        $members = User::query()
            ->whereNotNull('member_since')
            ->orderByDesc('member_since')
            ->paginate(15);

        return view('admin.members.index', compact('members'));
    }

    public function revoke(User $user): RedirectResponse
    {
        $user->update(['is_member' => false]);

        return redirect()->route('admin.members.index')
            ->with('success', "{$user->name}'s membership has been revoked.");
    }

    public function destroy(User $user): RedirectResponse
    {
        $name = $user->name;
        MemberAccessToken::where('email', $user->email)->delete();
        $user->delete();

        return redirect()->route('admin.members.index')
            ->with('success', "{$name} has been deleted.");
    }
}
