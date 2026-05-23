<?php

namespace App\Console\Commands;

use App\Mail\MembershipExpiryReminderMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMembershipExpiryReminders extends Command
{
    protected $signature = 'members:send-expiry-reminders';

    protected $description = 'Send reminder emails to members whose membership expires in 7 days';

    public function handle(): int
    {
        $targetDate = now()->addDays(7)->toDateString();

        User::where('is_member', true)
            ->whereNotNull('member_since')
            ->whereRaw('DATE_ADD(member_since, INTERVAL 6 MONTH) = ?', [$targetDate])
            ->each(fn (User $user) => Mail::to($user->email)->send(new MembershipExpiryReminderMail($user))
            );

        $this->info("Expiry reminders sent for {$targetDate}.");

        return self::SUCCESS;
    }
}
