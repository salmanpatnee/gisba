<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:clear-all-cache')]
#[Description('Clear route, config, view, and application cache')]
class ClearAllCache extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('route:clear');
        $this->call('config:clear');
        $this->call('view:clear');
        $this->call('cache:clear');

        $this->info('All caches cleared.');
    }
}
