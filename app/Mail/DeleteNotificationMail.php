<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeleteNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $subjectLabel,
        public string $recordLabel,
        public string $deletedBy,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLabel.' supprimé',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.deletion-notification',
        );
    }
}
