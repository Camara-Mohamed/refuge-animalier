<?php

namespace App\Mail;

use App\Models\Animal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnimalStatusUpdatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Animal $animal) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Statut mis à jour : '.$this->animal->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.animal-status-updated',
        );
    }
}
