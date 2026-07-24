<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetMemberPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $resetUrl,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Your GISBA Password',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-member-password',
            with: [
                'resetUrl' => $this->resetUrl,
                'expireMinutes' => config('auth.passwords.users.expire'),
            ],
        );
    }
}
