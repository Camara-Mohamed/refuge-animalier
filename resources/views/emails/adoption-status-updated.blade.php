@extends('emails.layout')

@section('content')
    @if ($adoption->status === \App\Enums\AdoptionStatus::ACCEPTED)
        <h1>Demande acceptée</h1>

        <p>Bonjour {{ $adoption->adopter->name }},</p>
        <p>Votre demande d'adoption pour {{ $adoption->animal->name }} a été acceptée.</p>
    @else
        <h1>Demande refusée</h1>

        <p>Bonjour {{ $adoption->adopter->name }},</p>
        <p>Votre demande d'adoption pour {{ $adoption->animal->name }} a été refusée.</p>
    @endif
@endsection
