<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipExpiryReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your GISBA Membership Expires in 7 Days',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.membership-expiry-reminder',
            with: [
                'userName' => $this->user->name,
                'expiresAt' => $this->user->memberExpiresAt()->format('F j, Y'),
                'renewUrl' => route('members.paywall'),
            ],
        );
    }
}
