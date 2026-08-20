<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteer_applications'), 'url' => route('admin.volunteer-applications.index', ['locale' => app()->getLocale()])],
    ]" :key="'volunteer-applications-index-breadcrumb'" />

    <h1 class="font-serif font-bold text-2xl text-blue-strong">Candidatures bénévoles</h1>

    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="text-left font-sans text-sm text-blue-strong/60 py-2">Nom</th>
                <th class="text-left font-sans text-sm text-blue-strong/60 py-2">Email</th>
                <th class="text-left font-sans text-sm text-blue-strong/60 py-2">Reçue le</th>
                <th class="text-left font-sans text-sm text-blue-strong/60 py-2">Statut</th>
                <th class="py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($applications as $application)
                <tr wire:key="application-{{ $application->id }}">
                    <td class="py-2 font-sans {{ $application->isRead() ? 'text-blue-strong/70' : 'font-bold text-blue-strong' }}">
                        {{ $application->name }}
                    </td>
                    <td class="py-2 font-sans {{ $application->isRead() ? 'text-blue-strong/70' : 'font-bold text-blue-strong' }}">
                        {{ $application->email }}
                    </td>
                    <td class="py-2 font-sans text-blue-strong/70">{{ $application->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-2">
                        <x-badge :color="$application->isRead() ? 'bg-gray-100 text-gray-600' : 'bg-red-strong/10 text-red-strong'">
                            {{ $application->isRead() ? 'Lue' : 'Non lue' }}
                        </x-badge>
                    </td>
                    <td class="py-2 text-right flex items-center justify-end gap-4">
                        <x-admin-link :href="route('admin.volunteer-applications.show', ['locale' => app()->getLocale(), 'volunteerApplication' => $application])"
                           class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                            Voir
                        </x-admin-link>
                        <button wire:click="delete({{ $application->id }})" wire:confirm="Supprimer cette candidature ?"
                                class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                            Supprimer
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-6 text-center font-sans text-blue-strong/50">
                        Aucune candidature pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $applications->links() }}
    </div>
</div>
