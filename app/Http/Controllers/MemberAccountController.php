<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMemberPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class MemberAccountController extends Controller
{
    public function edit(): View
    {
        return view('pages.members.account', ['user' => auth()->user()]);
    }

    public function updatePassword(UpdateMemberPasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        Auth::logoutOtherDevices($validated['password']);

        return redirect()->route('members.account.edit')
            ->with('success', 'Your password has been updated. Other devices have been logged out.');
    }
}
