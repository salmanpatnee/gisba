<?php

namespace App\Http\Middleware;

use App\Enums\SessionStatus;
use App\Models\UserSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackUserActivity
{
    private const PING_INTERVAL_SECONDS = 60;

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $user = auth()->user();

        if (! $user || ! $user->isMember()) {
            return $response;
        }

        $token = session('user_activity_token');

        if (! $token) {
            return $response;
        }

        $lastPing = (int) session('user_activity_last_ping', 0);

        if (now()->timestamp - $lastPing < self::PING_INTERVAL_SECONDS) {
            return $response;
        }

        try {
            UserSession::where('session_token', $token)
                ->where('status', SessionStatus::Active)
                ->update(['last_activity_at' => now()]);

            session(['user_activity_last_ping' => now()->timestamp]);
        } catch (Throwable $e) {
            Log::error('Failed to record user activity heartbeat.', [
                'user_id' => $user->id,
                'exception' => $e,
            ]);
        }

        return $response;
    }
}
