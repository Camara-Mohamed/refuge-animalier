<p>{{ $user->name }} a mis à jour son profil.</p>

<p>
    <a href="{{ route('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $user]) }}">
        Voir la fiche
    </a>
</p>
