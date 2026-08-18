<?php

namespace App\Mail;

use App\Models\Animal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAnimalMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Animal $animal) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvel animal ajouté : '.$this->animal->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-animal',
        );
    }
}
