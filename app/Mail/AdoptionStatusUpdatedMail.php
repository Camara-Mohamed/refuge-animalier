<?php

namespace App\Mail;

use App\Enums\AdoptionStatus;
use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdoptionStatusUpdatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Adoption $adoption) {}

    public function envelope(): Envelope
    {
        $subject = $this->adoption->status === AdoptionStatus::ACCEPTED
            ? 'Votre demande d\'adoption a été acceptée !'
            : 'Votre demande d\'adoption';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.adoption-status-updated',
        );
    }
}
