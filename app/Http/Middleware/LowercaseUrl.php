<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LowercaseUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        if ($path !== strtolower($path)) {
            return redirect(strtolower($path));
        }
    
        return $next($request);
    }
}
