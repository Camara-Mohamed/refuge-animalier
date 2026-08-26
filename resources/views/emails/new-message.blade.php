@extends('emails.layout')

@section('content')
    <h1>Nouveau message</h1>

    <p><strong>De :</strong> {{ $contactMessage->name }} ({{ $contactMessage->email }})</p>
    <p><strong>Sujet :</strong> {{ $contactMessage->subject ?? '-' }}</p>

    <hr class="divider">

    <p>{{ $contactMessage->message }}</p>

    <hr class="divider">

    <a href="{{ route('admin.messages.show', ['locale' => app()->getLocale(), 'message' => $contactMessage]) }}" class="btn">
        Voir le message
    </a>
@endsection
