<?php

namespace App\Http\Middleware;

use App\Models\SessionActivity;
use App\Support\PageVisitLabeler;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackPageVisit
{
    private const DEDUPE_WINDOW_SECONDS = 3;

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $user = auth()->user();

        if (! $user || ! $user->isMember()) {
            return $response;
        }

        $userSessionId = session('user_activity_session_id');

        if (! $userSessionId) {
            return $response;
        }

        if (! $request->isMethod('get')
            || $response->getStatusCode() !== 200
            || $request->ajax()
            || $request->wantsJson()) {
            return $response;
        }

        $routeName = $request->route()?->getName();

        if (! $routeName) {
            return $response;
        }

        $lastRoute = session('page_visit_last_route');
        $lastRouteAt = (int) session('page_visit_last_route_at', 0);

        if ($lastRoute === $routeName && now()->timestamp - $lastRouteAt < self::DEDUPE_WINDOW_SECONDS) {
            return $response;
        }

        try {
            SessionActivity::create([
                'user_session_id' => $userSessionId,
                'user_id' => $user->id,
                'route_name' => $routeName,
                'url' => $request->path(),
                'method' => $request->method(),
                'label' => PageVisitLabeler::label($routeName),
                'module' => PageVisitLabeler::module($routeName),
                'occurred_at' => now(),
            ]);

            session([
                'page_visit_last_route' => $routeName,
                'page_visit_last_route_at' => now()->timestamp,
            ]);
        } catch (Throwable $e) {
            Log::error('Failed to record page visit activity.', [
                'user_id' => $user->id,
                'exception' => $e,
            ]);
        }

        return $response;
    }
}
