<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteers'), 'url' => route('admin.volunteers.index', ['locale' => app()->getLocale()])],
        ['label' => $volunteer->name, 'url' => '#'],
    ]" :key="'volunteer-show-breadcrumb'" />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-2">
            <h1 class="font-serif font-bold text-2xl text-blue-strong">{{ $volunteer->name }}</h1>
            <x-badge :color="$volunteer->role->color()">{{ $volunteer->role->label() }}</x-badge>
        </div>

        <div class="flex items-center gap-4">
            @can('update', $volunteer)
                <x-admin-link :href="route('admin.volunteers.edit', ['locale' => app()->getLocale(), 'volunteer' => $volunteer])"
                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                    Modifier
                </x-admin-link>
            @endcan

            @can('delete', $volunteer)
                <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $volunteer->id }}', model_type: 'volunteer' } })"
                        class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                    Supprimer
                </button>
            @endcan
        </div>
    </div>

    @if ($volunteer->avatar)
        <img src="{{ Storage::url($volunteer->avatar) }}" alt="{{ $volunteer->name }}" width="120" class="rounded-full">
    @endif

    <ul class="flex flex-col gap-1 font-sans text-sm text-blue-strong">
        <li>Email : {{ $volunteer->email }}</li>
        <li>Téléphone : {{ $volunteer->phone ?? '—' }}</li>
        <li>Adresse : {{ $volunteer->address ?? '—' }} {{ $volunteer->number ?? '' }}, {{ $volunteer->code_postal ?? '' }} {{ $volunteer->city ?? '' }}</li>
    </ul>
</div>
