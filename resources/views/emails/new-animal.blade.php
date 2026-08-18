@extends('emails.layout')

@section('content')
    <h1>Nouvel animal</h1>

    <p>Un nouvel animal a été ajouté par {{ $animal->user?->fullName() ?? 'un bénévole' }}.</p>

    <hr class="divider">

    <p><strong>Nom :</strong> {{ $animal->name }}</p>
    <p><strong>Espèce :</strong> {{ $animal->specie?->name ?? '—' }}</p>

    <hr class="divider">

    <a href="{{ route('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal]) }}" class="btn">
        Voir la fiche
    </a>
@endsection
