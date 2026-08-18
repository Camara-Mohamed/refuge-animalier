<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VolunteerAccountCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public User $volunteer, public string $password) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre compte Les Pattes Heureuses a été créé',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.volunteer-account-created',
        );
    }
}
