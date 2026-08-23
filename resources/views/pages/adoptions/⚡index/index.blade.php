<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.adoptions'), 'url' => route('admin.adoptions.index', ['locale' => app()->getLocale()])],
    ]" :key="'adoptions-index-breadcrumb'" />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h1 class="font-serif font-bold text-2xl text-blue-strong">Adoptions</h1>

        @can('create', \App\Models\Adoption::class)
            <x-admin-link :href="route('admin.adoptions.create', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg bg-red-strong text-white font-sans text-sm font-semibold hover:bg-red-normal">
                Nouvelle adoption
            </x-admin-link>
        @endcan
    </div>

    <x-forms.select for="statusFilter" wire:model.live="statusFilter" label_title="Filtrer par statut">
        <option value="">Tous les statuts</option>
        @foreach (\App\Enums\AdoptionStatus::cases() as $status)
            <option value="{{ $status->value }}">{{ $status->label() }}</option>
        @endforeach
    </x-forms.select>

    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Adoptant</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Animal</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Demandée le</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Statut</th>
                <th class="py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($adoptions as $adoption)
                <tr wire:key="adoption-{{ $adoption->id }}">
                    <td class="py-2 font-sans text-blue-strong">{{ $adoption->adopter->name }}</td>
                    <td class="py-2 font-sans text-blue-strong/70">{{ $adoption->animal->name }}</td>
                    <td class="py-2 font-sans text-blue-strong/70">{{ $adoption->created_at->format('d/m/Y') }}</td>
                    <td class="py-2">
                        @can('changeStatus', $adoption)
                            <select wire:change="changeStatus({{ $adoption->id }}, $event.target.value)"
                                    class="px-2 py-1 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong">
                                @foreach (\App\Enums\AdoptionStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($status === $adoption->status)>{{ $status->label() }}</option>
                                @endforeach
                            </select>
                        @else
                            <x-badge :color="$adoption->status->color()">{{ $adoption->status->label() }}</x-badge>
                        @endcan
                    </td>
                    <td class="py-2 text-right flex items-center justify-end gap-4">
                        <x-admin-link :href="route('admin.adoptions.show', ['locale' => app()->getLocale(), 'adoption' => $adoption])"
                           class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                            Voir
                        </x-admin-link>
                        @can('delete', $adoption)
                            <button wire:click="delete({{ $adoption->id }})" wire:confirm="Supprimer cette demande ?"
                                    class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                Supprimer
                            </button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-6 text-center font-sans text-blue-strong/70">
                        Aucune demande pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $adoptions->links() }}
    </div>
</div>
