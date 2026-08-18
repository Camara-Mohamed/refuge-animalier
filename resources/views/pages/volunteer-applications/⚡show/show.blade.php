<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteer_applications'), 'url' => route('admin.volunteer-applications.index', ['locale' => app()->getLocale()])],
        ['label' => $application->name, 'url' => '#'],
    ]" :key="'volunteer-application-show-breadcrumb'" />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h1 class="font-serif font-bold text-2xl text-blue-strong">{{ $application->name }}</h1>

        <div class="flex items-center gap-4">
            @can('create', \App\Models\User::class)
                <a href="{{ route('admin.volunteers.create', ['locale' => app()->getLocale()]) }}"
                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                    Créer un compte
                </a>
            @endcan

            <a href="mailto:{{ $application->email }}" class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                Répondre
            </a>

            @can('delete', $application)
                <button wire:click="delete" wire:confirm="Supprimer cette candidature ?"
                        class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                    Supprimer
                </button>
            @endcan
        </div>
    </div>

    <ul class="flex flex-col gap-1 font-sans text-sm text-blue-strong">
        <li>Email : {{ $application->email }}</li>
        <li>Téléphone : {{ $application->phone }}</li>
        <li>Adresse : {{ $application->address }} {{ $application->number }}, {{ $application->code_postal }} {{ $application->city }}</li>
        <li>
            Disponibilités :
            {{ collect($application->availabilities ?? [])->map(fn ($day) => \App\Enums\Day::from($day)->label())->implode(', ') ?: '—' }}
        </li>
        <li>Reçue le : {{ $application->created_at->format('d/m/Y H:i') }}</li>
    </ul>
</div>
