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

    /** @var array<string, array{label: string, perk: string|null}> Course slug => display metadata. */
    private const COURSES = [
        'crisc' => ['label' => 'CRISC Online Course', 'perk' => 'A free copy of "CRISC and Beyond" is reserved for you.'],
        'cissp' => ['label' => 'CISSP Live Online Training', 'perk' => null],
        'prince2' => ['label' => 'PRINCE2 Live Online Training', 'perk' => null],
    ];

    public function __construct(
        public readonly CourseEnrollment $enrollment,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "You're enrolled — {$this->courseLabel()}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.course-enrollment-confirmation',
            with: [
                'enrollment' => $this->enrollment,
                'settings' => SiteSettings::current(),
                'courseLabel' => $this->courseLabel(),
                'coursePerk' => self::COURSES[$this->enrollment->course]['perk'] ?? null,
            ],
        );
    }

    private function courseLabel(): string
    {
        return self::COURSES[$this->enrollment->course]['label'] ?? $this->enrollment->course;
    }
}
