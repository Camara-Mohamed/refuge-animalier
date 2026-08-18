@extends('emails.layout')

@section('content')
    <h1>Nouvelle candidature bénévole</h1>

    <p><strong>De :</strong> {{ $application->name }} ({{ $application->email }})</p>
    <p><strong>Téléphone :</strong> {{ $application->phone }}</p>
    <p><strong>Adresse :</strong> {{ $application->address }} {{ $application->number }}, {{ $application->code_postal }} {{ $application->city }}</p>

    <hr class="divider">

    <p><strong>Disponibilités :</strong>
        {{ collect($application->availabilities ?? [])->map(fn ($day) => \App\Enums\Day::from($day)->label())->implode(', ') ?: '—' }}
    </p>
@endsection
