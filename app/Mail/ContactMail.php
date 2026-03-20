<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var array<string, string> */
    private static array $serviceLabels = [
        'nis2' => 'NIS2 Implementation Kit',
        'training' => 'Cybersecurity Training Development Services',
        'consulting' => 'Cybersecurity Consulting',
        'project-management' => 'Project Management Consulting',
        'other' => 'Other / General Enquiry',
    ];

    /** @var array<string, string> */
    private static array $heardFromLabels = [
        'linkedin' => 'LinkedIn',
        'google' => 'Google Search',
        'diac' => 'DIAC (Partner\'s Website)',
        'visionary-alpha' => 'Visionary Alpha (Partner\'s Website)',
        'other' => 'Others',
    ];

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $organization,
        public readonly string $service,
        public readonly string $heardFrom,
        public readonly string $message,
    ) {}

    public function envelope(): Envelope
    {
        $serviceLabel = self::$serviceLabels[$this->service] ?? null;
        $subject = 'New Enquiry via GISBA Website'.($serviceLabel ? ' — '.$serviceLabel : '');

        return new Envelope(
            subject: $subject,
            replyTo: [new Address($this->email, $this->name)],
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.enquiry',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'organization' => $this->organization,
                'serviceLabel' => self::$serviceLabels[$this->service] ?? 'Not specified',
                'heardFromLabel' => self::$heardFromLabels[$this->heardFrom] ?? $this->heardFrom,
                'body' => $this->message,
            ],
        );
    }
}
