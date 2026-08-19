<div class="flex flex-col gap-6">
    <h1 class="font-serif font-bold text-2xl text-blue-strong">Tableau de bord</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @can('manage-animals')
            <a href="{{ route('admin.animals.index', ['locale' => app()->getLocale()]) }}"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['animals_total'] }}</span>
                <span class="font-sans text-sm text-blue-strong/60">Animaux ({{ $stats['animals_adoptable'] }} adoptables)</span>
            </a>
        @endcan

        @can('manage-adoptions')
            <a href="{{ route('admin.adoptions.index', ['locale' => app()->getLocale()]) }}"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['adoptions_pending'] }}</span>
                <span class="font-sans text-sm text-blue-strong/60">Demandes d'adoption en attente</span>
            </a>
        @endcan

        @can('manage-messages')
            <a href="{{ route('admin.messages.index', ['locale' => app()->getLocale()]) }}"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['messages_unread'] }}</span>
                <span class="font-sans text-sm text-blue-strong/60">Messages non lus</span>
            </a>
        @endcan

        @can('manage-volunteers')
            <a href="{{ route('admin.volunteers.index', ['locale' => app()->getLocale()]) }}"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['volunteers_total'] }}</span>
                <span class="font-sans text-sm text-blue-strong/60">Bénévoles</span>
            </a>

            <a href="{{ route('admin.volunteer-applications.index', ['locale' => app()->getLocale()]) }}"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['applications_unread'] }}</span>
                <span class="font-sans text-sm text-blue-strong/60">Candidatures non lues</span>
            </a>
        @endcan
    </div>

    <div class="flex items-center gap-3 flex-wrap">
        @can('create', \App\Models\Animal::class)
            <a href="{{ route('admin.animals.create', ['locale' => app()->getLocale()]) }}"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-white bg-red-strong hover:bg-red-normal transition-colors">
                + Ajouter un animal
            </a>
        @endcan

        @can('create', \App\Models\User::class)
            <a href="{{ route('admin.volunteers.create', ['locale' => app()->getLocale()]) }}"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-red-strong border border-red-strong hover:bg-red-light transition-colors">
                + Créer un profil bénévole
            </a>
        @endcan

        @can('manage-data')
            <a href="{{ route('admin.data.index', ['locale' => app()->getLocale()]) }}"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-blue-strong border border-gray-200 hover:border-blue-strong transition-colors">
                Gérer les données
            </a>
        @endcan

        @can('manage-messages')
            <a href="{{ route('admin.messages.index', ['locale' => app()->getLocale()]) }}"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-blue-strong border border-gray-200 hover:border-blue-strong transition-colors">
                Voir les messages
            </a>
        @endcan
    </div>
</div>
