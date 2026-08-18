@extends('emails.layout')

@section('content')
    <h1>{{ $subjectLabel }} supprimé</h1>

    <p><strong>{{ $recordLabel }}</strong> a été supprimé par {{ $deletedBy }}.</p>
@endsection
