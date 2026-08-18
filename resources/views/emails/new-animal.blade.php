<p>Un nouvel animal a été ajouté par {{ $animal->user?->fullName() ?? 'un bénévole' }}.</p>

<ul>
    <li><strong>Nom :</strong> {{ $animal->name }}</li>
    <li><strong>Espèce :</strong> {{ $animal->specie?->name ?? '—' }}</li>
</ul>

<p>
    <a href="{{ route('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal]) }}">
        Voir la fiche
    </a>
</p>
