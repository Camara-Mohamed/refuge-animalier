@extends('emails.layout')

@section('content')
    <h1>Statut mis à jour</h1>

    <p>{{ $animal->name }} est maintenant : {{ $animal->status->label() }}.</p>

    <a href="{{ route('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal]) }}" class="btn">
        Voir la fiche
    </a>
@endsection
