<p>Un nouveau message a été reçu via le formulaire de contact.</p>

<ul>
    <li><strong>De :</strong> {{ $message->name }} ({{ $message->email }})</li>
    <li><strong>Sujet :</strong> {{ $message->subject ?? '—' }}</li>
</ul>

<p>{{ $message->message }}</p>

<p>
    <a href="{{ route('admin.messages.show', ['locale' => app()->getLocale(), 'message' => $message]) }}">
        Voir le message
    </a>
</p>
