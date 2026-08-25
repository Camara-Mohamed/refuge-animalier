<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteers'), 'url' => route('admin.volunteers.index', ['locale' => app()->getLocale()])],
    ]" :key="'volunteers-index-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h2 class="font-serif font-bold text-2xl text-blue-strong">Bénévoles</h2>
    </div>

    <div class="flex items-center gap-3 flex-wrap">
        <x-forms.input for="search" type="text" placeholder="Rechercher un nom ou un email..."
                        wire:model.live.debounce.300ms="search" class="w-64">
            <span class="sr-only">Rechercher</span>
        </x-forms.input>

        <x-forms.select for="roleFilter" wire:model.live="roleFilter" label_title="Filtrer par rôle">
            <option value="">Tous les rôles</option>
            @foreach (\App\Enums\UserRole::cases() as $role)
                <option value="{{ $role->value }}">{{ $role->label() }}</option>
            @endforeach
        </x-forms.select>

        @can('create', \App\Models\User::class)
            <x-admin-link :href="route('admin.volunteers.create', ['locale' => app()->getLocale()])"
                          class="px-4 h-[50px] flex items-center rounded-lg bg-red-strong text-white font-sans text-sm
                          font-semibold
                          hover:bg-red-normal">
                Créer un profil
            </x-admin-link>
        @endcan
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($volunteers as $volunteer)
            <div wire:key="volunteer-{{ $volunteer->id }}"
                 class="p-4 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-2">
                <div class="flex items-start justify-between gap-2">
                    <span class="font-sans font-bold text-blue-strong">{{ $volunteer->name }}</span>
                    <x-badge :color="$volunteer->role->color()">{{ $volunteer->role->label() }}</x-badge>
                </div>

                <span class="font-sans text-sm text-blue-strong/70">{{ $volunteer->email }}</span>

                <div class="flex items-center gap-4 mt-2 pt-2 border-t border-red-strong/10">
                    <x-admin-link :href="route('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $volunteer])"
                       class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                        Voir
                    </x-admin-link>
                </div>
            </div>
        @empty
            <p class="font-sans text-blue-strong/70">Aucun bénévole trouvé.</p>
        @endforelse
    </div>

    <div>
        {{ $volunteers->links() }}
    </div>
</div>
