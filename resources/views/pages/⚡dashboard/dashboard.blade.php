<div class="flex flex-col gap-6" wire:poll.30s>
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h1 class="font-serif font-bold text-2xl text-blue-strong">Tableau de bord</h1>

        <div class="flex items-center gap-2">
            <select wire:model.live="selectedMonth"
                    class="px-4 py-2 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong">
                <option value="">Toutes les périodes</option>
                @foreach ($months as $month)
                    <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                @endforeach
            </select>

            @can('manage-reports')
                @php
                    [$pdfYear, $pdfMonth] = $selectedMonth
                        ? explode('-', $selectedMonth)
                        : [now()->format('Y'), now()->format('m')];
                @endphp
                {{-- Téléchargement de fichier : pas de wire:navigate ici --}}
                <a href="{{ route('admin.reports.download', ['locale' => app()->getLocale(), 'month' => $pdfMonth, 'year' => $pdfYear]) }}"
                   class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-blue-strong border border-gray-200 hover:border-blue-strong transition-colors">
                    Télécharger PDF
                </a>
            @endcan
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @can('manage-animals')
            <x-admin-link :href="route('admin.animals.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['animals_total'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">
                    Animaux {{ $selectedMonth ? 'ajoutés sur la période' : "({$stats['animals_adoptable']} adoptables)" }}
                </span>
            </x-admin-link>
        @endcan

        @can('manage-adoptions')
            <x-admin-link :href="route('admin.adoptions.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['adoptions_pending'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">Demandes d'adoption en attente</span>
            </x-admin-link>

            <x-admin-link :href="route('admin.adoptions.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['adoptions_completed'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">Adoptions réussies {{ $selectedMonth ? 'sur la période' : '' }}</span>
            </x-admin-link>
        @endcan

        @can('manage-messages')
            <x-admin-link :href="route('admin.messages.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['messages_unread'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">Messages non lus</span>
            </x-admin-link>
        @endcan

        @can('manage-volunteers')
            <x-admin-link :href="route('admin.volunteers.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['volunteers_total'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">Bénévoles</span>
            </x-admin-link>

            <x-admin-link :href="route('admin.volunteer-applications.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['applications_unread'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">Candidatures non lues</span>
            </x-admin-link>
        @endcan
    </div>

    <div class="flex items-center gap-3 flex-wrap">
        @can('create', \App\Models\Animal::class)
            <x-admin-link :href="route('admin.animals.create', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-white bg-red-strong hover:bg-red-normal transition-colors">
                + Ajouter un animal
            </x-admin-link>
        @endcan

        @can('create', \App\Models\User::class)
            <x-admin-link :href="route('admin.volunteers.create', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-red-strong border border-red-strong hover:bg-red-light transition-colors">
                + Créer un profil bénévole
            </x-admin-link>
        @endcan

        @can('manage-data')
            <x-admin-link :href="route('admin.data.index', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-blue-strong border border-gray-200 hover:border-blue-strong transition-colors">
                Gérer les données
            </x-admin-link>
        @endcan

        @can('manage-messages')
            <x-admin-link :href="route('admin.messages.index', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-blue-strong border border-gray-200 hover:border-blue-strong transition-colors">
                Voir les messages
            </x-admin-link>
        @endcan
    </div>

    @can('manage-animals')
        <x-dashboard.section title="Animaux à traiter" term="animalSearch" placeholder="Rechercher un nom...">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Nom</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Espèce</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($animalsPending as $animal)
                        <tr wire:key="animal-{{ $animal->id }}">
                            <td class="py-2 font-sans text-blue-strong">{{ $animal->name }}</td>
                            <td class="py-2 font-sans text-blue-strong/70">{{ $animal->specie?->name ?? '—' }}</td>
                            <td class="py-2 text-right flex items-center justify-end gap-2">
                                @can('update', $animal)
                                    <select wire:change="changeAnimalStatus({{ $animal->id }}, $event.target.value)"
                                            class="px-2 py-1 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong">
                                        @foreach (\App\Enums\AnimalStatus::cases() as $status)
                                            <option value="{{ $status->value }}" @selected($status === $animal->status)>{{ $status->label() }}</option>
                                        @endforeach
                                    </select>
                                @endcan

                                <x-admin-link :href="route('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal])"
                                   class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                                    Voir
                                </x-admin-link>
                                @can('update', $animal)
                                    <x-admin-link :href="route('admin.animals.edit', ['locale' => app()->getLocale(), 'animal' => $animal])"
                                       class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                        Modifier
                                    </x-admin-link>
                                @endcan
                                @can('delete', $animal)
                                    <button wire:click="deleteAnimal({{ $animal->id }})"
                                            wire:confirm="Supprimer {{ $animal->name }} ? Cette action est irréversible."
                                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                        Supprimer
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                Aucun animal à traiter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $animalsPending->links() }}
        </x-dashboard.section>
    @endcan

    @can('manage-adoptions')
        <x-dashboard.section title="Adoptions en attente" term="adoptionSearch" placeholder="Rechercher un adoptant ou un animal...">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Adoptant</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Animal</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($adoptionsPending as $adoption)
                        <tr wire:key="adoption-{{ $adoption->id }}">
                            <td class="py-2 font-sans text-blue-strong">{{ $adoption->adopter->name }}</td>
                            <td class="py-2 font-sans text-blue-strong/70">{{ $adoption->animal->name }}</td>
                            <td class="py-2 text-right flex items-center justify-end gap-2">
                                @can('changeStatus', $adoption)
                                    <select wire:change="changeAdoptionStatus({{ $adoption->id }}, $event.target.value)"
                                            class="px-2 py-1 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong">
                                        @foreach (\App\Enums\AdoptionStatus::cases() as $status)
                                            <option value="{{ $status->value }}" @selected($status === $adoption->status)>{{ $status->label() }}</option>
                                        @endforeach
                                    </select>
                                @endcan

                                <x-admin-link :href="route('admin.adoptions.show', ['locale' => app()->getLocale(), 'adoption' => $adoption])"
                                   class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                                    Voir
                                </x-admin-link>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                Aucune adoption en attente.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $adoptionsPending->links() }}
        </x-dashboard.section>
    @endcan

    @can('manage-messages')
        <x-dashboard.section title="Messages non lus" term="messageSearch" placeholder="Rechercher un nom ou un sujet...">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">De</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Sujet</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($messagesUnread as $message)
                        <tr wire:key="message-{{ $message->id }}">
                            <td class="py-2 font-sans text-blue-strong">{{ $message->name }}</td>
                            <td class="py-2 font-sans text-blue-strong/70">{{ $message->subject ?? '—' }}</td>
                            <td class="py-2 text-right flex items-center justify-end gap-4">
                                <x-admin-link :href="route('admin.messages.show', ['locale' => app()->getLocale(), 'message' => $message])"
                                   class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                                    Voir
                                </x-admin-link>
                                <a href="mailto:{{ $message->email }}"
                                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                    Répondre
                                </a>
                                @can('delete', $message)
                                    <button wire:click="deleteMessage({{ $message->id }})"
                                            wire:confirm="Supprimer ce message ?"
                                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                        Supprimer
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                Aucun message non lu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $messagesUnread->links() }}
        </x-dashboard.section>
    @endcan

    @can('manage-volunteers')
        <x-dashboard.section title="Candidatures bénévoles non lues" term="applicationSearch" placeholder="Rechercher un nom...">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Nom</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Email</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($applicationsUnread as $application)
                        <tr wire:key="application-{{ $application->id }}">
                            <td class="py-2 font-sans text-blue-strong">{{ $application->name }}</td>
                            <td class="py-2 font-sans text-blue-strong/70">{{ $application->email }}</td>
                            <td class="py-2 text-right flex items-center justify-end gap-4">
                                <x-admin-link :href="route('admin.volunteer-applications.show', ['locale' => app()->getLocale(), 'volunteerApplication' => $application])"
                                   class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                                    Voir
                                </x-admin-link>
                                @can('create', \App\Models\User::class)
                                    <x-admin-link :href="route('admin.volunteers.create', ['locale' => app()->getLocale()])"
                                       class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                        Créer un compte
                                    </x-admin-link>
                                @endcan
                                <a href="mailto:{{ $application->email }}"
                                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                    Répondre
                                </a>
                                @can('delete', $application)
                                    <button wire:click="deleteApplication({{ $application->id }})"
                                            wire:confirm="Supprimer cette candidature ?"
                                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                        Supprimer
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                Aucune candidature non lue.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $applicationsUnread->links() }}
        </x-dashboard.section>
    @endcan
</div>
