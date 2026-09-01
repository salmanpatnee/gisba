<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DiscountRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly int $discountPercentage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "CISSP Discount Request — {$this->discountPercentage}% requested",
            replyTo: [new Address($this->email, $this->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.discount-request',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'discountPercentage' => $this->discountPercentage,
            ],
        );
    }
}
