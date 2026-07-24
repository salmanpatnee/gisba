<?php

namespace App\Console\Commands;

use App\Enums\SessionStatus;
use App\Models\UserSession;
use Illuminate\Console\Command;

class CloseStaleUserSessions extends Command
{
    protected $signature = 'sessions:close-stale';

    protected $description = 'Close user_sessions rows inactive past the online threshold';

    public function handle(): int
    {
        $cutoff = UserSession::onlineCutoff();
        $closed = 0;

        UserSession::query()->stale($cutoff)->each(function (UserSession $session) use (&$closed): void {
            $session->update([
                'status' => SessionStatus::Ended,
                'logout_at' => $session->last_activity_at,
                'duration_seconds' => $session->login_at->diffInSeconds($session->last_activity_at),
            ]);

            $closed++;
        });

        $this->info("Closed {$closed} stale user session(s).");

        return self::SUCCESS;
    }
}
