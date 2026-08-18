@extends('emails.layout')

@section('content')
    <h1>Profil mis à jour</h1>

    <p>{{ $user->name }} a mis à jour son profil.</p>

    <hr class="divider">

    <a href="{{ route('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $user]) }}" class="btn">
        Voir la fiche
    </a>
@endsection
