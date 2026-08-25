@extends('emails.layout')

@section('content')
    <h1>Nouveau message</h1>

    <p><strong>De :</strong> {{ $message->name }} ({{ $message->email }})</p>
    <p><strong>Sujet :</strong> {{ $message->subject ?? '-' }}</p>

    <hr class="divider">

    <p>{{ $message->message }}</p>

    <hr class="divider">

    <a href="{{ route('admin.messages.show', ['locale' => app()->getLocale(), 'message' => $message]) }}" class="btn">
        Voir le message
    </a>
@endsection
