<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteers'), 'url' => route('admin.volunteers.index', ['locale' => app()->getLocale()])],
    ]" :key="'volunteers-index-breadcrumb'" />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h1 class="font-serif font-bold text-2xl text-blue-strong">Bénévoles</h1>

        @can('create', \App\Models\User::class)
            <x-admin-link :href="route('admin.volunteers.create', ['locale' => app()->getLocale()])"
               class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                + Créer un profil
            </x-admin-link>
        @endcan
    </div>

    <div class="flex items-center gap-3 flex-wrap">
        <x-forms.input for="search" type="text" placeholder="Rechercher un nom ou un email..."
                        wire:model.live.debounce.300ms="search" class="w-64">
            Rechercher
        </x-forms.input>

        <x-forms.select for="roleFilter" wire:model.live="roleFilter" label_title="Filtrer par rôle">
            <option value="">Tous les rôles</option>
            @foreach (\App\Enums\UserRole::cases() as $role)
                <option value="{{ $role->value }}">{{ $role->label() }}</option>
            @endforeach
        </x-forms.select>
    </div>

    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="text-left font-sans text-sm text-blue-strong/60 py-2">Nom</th>
                <th class="text-left font-sans text-sm text-blue-strong/60 py-2">Email</th>
                <th class="text-left font-sans text-sm text-blue-strong/60 py-2">Rôle</th>
                <th class="py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($volunteers as $volunteer)
                <tr wire:key="volunteer-{{ $volunteer->id }}">
                    <td class="py-2 font-sans text-blue-strong">{{ $volunteer->name }}</td>
                    <td class="py-2 font-sans text-blue-strong/70">{{ $volunteer->email }}</td>
                    <td class="py-2">
                        <x-badge :color="$volunteer->role->color()">{{ $volunteer->role->label() }}</x-badge>
                    </td>
                    <td class="py-2 text-right">
                        <x-admin-link :href="route('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $volunteer])"
                           class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                            Voir
                        </x-admin-link>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-6 text-center font-sans text-blue-strong/50">
                        Aucun bénévole trouvé.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $volunteers->links() }}
    </div>
</div>
