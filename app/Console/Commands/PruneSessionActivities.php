<?php

namespace App\Console\Commands;

use App\Models\SessionActivity;
use Illuminate\Console\Command;

class PruneSessionActivities extends Command
{
    protected $signature = 'sessions:prune-activities';

    protected $description = 'Delete session_activities rows older than the retention window';

    public function handle(): int
    {
        $retentionDays = (int) config('user-activity.activity_retention_days');

        $deleted = SessionActivity::where('occurred_at', '<', now()->subDays($retentionDays))->delete();

        $this->info("Pruned {$deleted} session activity record(s).");

        return self::SUCCESS;
    }
}
