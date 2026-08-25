<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteer_applications'), 'url' => route('admin.volunteer-applications.index', ['locale' => app()->getLocale()])],
    ]" :key="'volunteer-applications-index-breadcrumb'" />

    <x-flash />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">Candidatures bénévoles</h2>

    <div class="flex items-start gap-4 flex-wrap">
        <x-forms.input for="search" type="text" placeholder="Rechercher un nom ou un email..."
                        wire:model.live.debounce.300ms="search" class="w-64">
            <span class="sr-only">Rechercher</span>
        </x-forms.input>

        <x-filter-panel>
            <x-forms.select for="statusFilter" wire:model.live="statusFilter" label_title="Filtrer par statut">
                <option value="">Tous les statuts</option>
                <option value="unread">Non lue</option>
                <option value="read">Lue</option>
            </x-forms.select>
        </x-filter-panel>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($applications as $application)
            <div wire:key="application-{{ $application->id }}"
                 class="p-4 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-2">
                <div class="flex items-start justify-between gap-2">
                    <span class="font-sans {{ $application->isRead() ? 'text-blue-strong/70' : 'font-bold text-blue-strong' }}">
                        {{ $application->name }}
                    </span>
                    <x-badge :color="$application->isRead() ? 'bg-gray-100 text-gray-600' : 'bg-red-strong/10 text-red-strong'">
                        {{ $application->isRead() ? 'Lue' : 'Non lue' }}
                    </x-badge>
                </div>

                <span class="font-sans text-sm text-blue-strong/70">{{ $application->email }}</span>
                <span class="font-sans text-xs text-blue-strong/50">{{ $application->created_at->format('d/m/Y H:i') }}</span>

                <div class="flex items-center gap-4 mt-2 pt-2 border-t border-red-strong/10">
                    <x-admin-link :href="route('admin.volunteer-applications.show', ['locale' => app()->getLocale(), 'volunteerApplication' => $application])"
                       class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                        Voir
                    </x-admin-link>
                    <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $application->id }}', model_type: 'volunteer-application' } })"
                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                        Supprimer
                    </button>
                </div>
            </div>
        @empty
            <p class="font-sans text-blue-strong/70">Aucune candidature pour le moment.</p>
        @endforelse
    </div>

    <div>
        {{ $applications->links() }}
    </div>
</div>
