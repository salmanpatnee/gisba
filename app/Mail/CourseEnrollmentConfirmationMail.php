<?php

namespace App\Mail;

use App\Models\CourseEnrollment;
use App\Models\SiteSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CourseEnrollmentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly CourseEnrollment $enrollment,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You\'re enrolled — CRISC Online Course',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.crisc-enrollment-confirmation',
            with: [
                'enrollment' => $this->enrollment,
                'settings' => SiteSettings::current(),
            ],
        );
    }
}
