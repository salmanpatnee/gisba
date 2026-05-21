<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMemberMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $memberEmail,
        public readonly ?string $password = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your GISBA Members Access',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-member',
            with: [
                'loginUrl' => route('members.login'),
            ],
        );
    }
}
