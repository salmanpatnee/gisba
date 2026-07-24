<?php

namespace App\Listeners;

use App\Enums\SessionStatus;
use App\Models\UserSession;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use Throwable;

class RecordUserLogout
{
    public function handle(Logout $event): void
    {
        $user = $event->user;

        if (! $user || ! $user->isMember()) {
            return;
        }

        try {
            $token = session('user_activity_token');

            if (! $token) {
                return;
            }

            $session = UserSession::where('session_token', $token)
                ->where('status', SessionStatus::Active)
                ->first();

            if (! $session) {
                return;
            }

            $now = now();

            $session->update([
                'logout_at' => $now,
                'duration_seconds' => $session->login_at->diffInSeconds($now),
                'status' => SessionStatus::Ended,
            ]);
        } catch (Throwable $e) {
            Log::error('Failed to record user logout activity.', [
                'user_id' => $user->id,
                'exception' => $e,
            ]);
        }
    }
}
