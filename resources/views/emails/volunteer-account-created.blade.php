@extends('emails.layout')

@section('content')
    <h1>Bienvenue</h1>

    <p>Bonjour {{ $volunteer->name }},</p>
    <p>Votre compte a été créé.</p>

    <hr class="divider">

    <p><strong>Email :</strong> {{ $volunteer->email }}</p>
    <p><strong>Mot de passe :</strong> {{ $password }}</p>

    <hr class="divider">

    <a href="{{ route('login', ['locale' => app()->getLocale()]) }}" class="btn">Se connecter</a>
@endsection
