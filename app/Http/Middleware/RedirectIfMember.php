<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfMember
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isMember()) {
            return redirect()->route('members.index')
                ->with('info', 'Members do not have access to the admin area.');
        }

        return $next($request);
    }
}
