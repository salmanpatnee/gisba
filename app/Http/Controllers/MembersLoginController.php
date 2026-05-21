<?php

namespace App\Http\Controllers;

use App\Http\Requests\MembersLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MembersLoginController extends Controller
{
    public function showForm(): View|RedirectResponse
    {
        if (auth()->check() && auth()->user()->isMember()) {
            return redirect()->route('members.index');
        }

        return view('pages.members-login');
    }

    public function login(MembersLoginRequest $request): RedirectResponse
    {
        if (! Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['email' => 'These credentials do not match our records.'])->withInput($request->only('email'));
        }

        if (! auth()->user()->isMember()) {
            Auth::logout();

            return back()->withErrors(['email' => 'Your account does not have member access. Please purchase a membership.'])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        return redirect()->route('members.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
