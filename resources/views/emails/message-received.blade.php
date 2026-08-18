@extends('emails.layout')

@section('content')
    <h1>Message bien reçu</h1>

    <p>Bonjour {{ $message->name }},</p>
    <p>Nous avons bien reçu votre message et nous vous répondrons dans les meilleurs délais.</p>

    <hr class="divider">

    <p><strong>Votre message :</strong></p>
    <p>{{ $message->message }}</p>
@endsection
