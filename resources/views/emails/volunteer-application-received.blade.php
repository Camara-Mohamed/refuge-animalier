@extends('emails.layout')

@section('content')
    <h1>Candidature bien reçue</h1>

    <p>Bonjour {{ $application->name }},</p>
    <p>Merci pour votre candidature pour devenir bénévole ! Nous reviendrons vers vous rapidement.</p>
@endsection
