<div class="flex flex-col gap-6" wire:poll.30s>
    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ __('admin/dashboard.title') }}</h2>

        <div class="flex items-center gap-2">
            <select wire:model.live="selectedMonth"
                    class="px-4 py-2 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong">
                <option value="">{{ __('admin/dashboard.all_periods') }}</option>
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
                    {{ __('admin/dashboard.download_pdf') }}
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
                    {{ __('admin/dashboard.animals_stat') }} {{ $selectedMonth ? __('admin/dashboard.animals_added_period') : __('admin/dashboard.animals_adoptable', ['count' => $stats['animals_adoptable']]) }}
                </span>
            </x-admin-link>
        @endcan

        @can('manage-adoptions')
            <x-admin-link :href="route('admin.adoptions.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['adoptions_pending'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">{{ __('admin/dashboard.adoptions_pending_stat') }}</span>
            </x-admin-link>

            <x-admin-link :href="route('admin.adoptions.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['adoptions_completed'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">{{ __('admin/dashboard.adoptions_completed_stat') }} {{ $selectedMonth ? __('admin/dashboard.adoptions_completed_period') : '' }}</span>
            </x-admin-link>
        @endcan

        @can('manage-messages')
            <x-admin-link :href="route('admin.messages.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['messages_unread'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">{{ __('admin/dashboard.messages_unread_stat') }}</span>
            </x-admin-link>
        @endcan

        @can('manage-volunteers')
            <x-admin-link :href="route('admin.volunteers.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['volunteers_total'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">{{ __('admin/dashboard.volunteers_stat') }}</span>
            </x-admin-link>

            <x-admin-link :href="route('admin.volunteer-applications.index', ['locale' => app()->getLocale()])"
               class="flex flex-col gap-1 p-4 rounded-lg border border-gray-200 hover:border-red-strong transition-colors">
                <span class="font-serif font-black text-3xl text-blue-strong">{{ $stats['applications_unread'] }}</span>
                <span class="font-sans text-sm text-blue-strong/70">{{ __('admin/dashboard.applications_unread_stat') }}</span>
            </x-admin-link>
        @endcan
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
        @can('create', \App\Models\Animal::class)
            <x-admin-link :href="route('admin.animals.create', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-white bg-red-strong hover:bg-red-normal transition-colors text-center">
                {{ __('admin/dashboard.add_animal') }}
            </x-admin-link>
        @endcan

        @can('create', \App\Models\User::class)
            <x-admin-link :href="route('admin.volunteers.create', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-red-strong border border-red-strong hover:bg-red-light transition-colors text-center">
                {{ __('admin/dashboard.create_volunteer_profile') }}
            </x-admin-link>
        @endcan

        @can('manage-data')
            <x-admin-link :href="route('admin.data.index', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-blue-strong border border-gray-200 hover:border-blue-strong transition-colors text-center">
                {{ __('admin/dashboard.manage_data') }}
            </x-admin-link>
        @endcan

        @can('manage-messages')
            <x-admin-link :href="route('admin.messages.index', ['locale' => app()->getLocale()])"
               class="px-4 py-2 rounded-lg font-sans font-bold text-sm text-blue-strong border border-gray-200 hover:border-blue-strong transition-colors text-center">
                {{ __('admin/dashboard.view_messages') }}
            </x-admin-link>
        @endcan
    </div>

    @can('manage-animals')
        <x-dashboard.section title="{{ __('admin/dashboard.animals_to_process') }}" term="animalSearch" placeholder="{{ __('admin/dashboard.search_name_placeholder') }}">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.name') }}</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.species') }}</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($animalsPending as $animal)
                        <tr wire:key="animal-{{ $animal->id }}">
                            <td class="py-2 font-sans text-blue-strong">{{ $animal->name }}</td>
                            <td class="py-2 font-sans text-blue-strong/70">{{ $animal->specie?->name ?? '-' }}</td>
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
                                    {{ __('admin/common.view') }}
                                </x-admin-link>
                                @can('update', $animal)
                                    <x-admin-link :href="route('admin.animals.edit', ['locale' => app()->getLocale(), 'animal' => $animal])"
                                       class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                        {{ __('admin/common.edit') }}
                                    </x-admin-link>
                                @endcan
                                @can('delete', $animal)
                                    <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $animal->id }}', model_type: 'animal', model_label: @js($animal->name) } })"
                                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                        {{ __('admin/common.delete') }}
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                {{ __('admin/dashboard.no_animals_to_process') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">{{ $animalsPending->links() }}</div>
        </x-dashboard.section>
    @endcan

    @can('manage-adoptions')
        <x-dashboard.section title="{{ __('admin/dashboard.adoptions_pending') }}" term="adoptionSearch" placeholder="{{ __('admin/dashboard.search_adopter_animal_placeholder') }}">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.adopter') }}</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.animal') }}</th>
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
                                    {{ __('admin/common.view') }}
                                </x-admin-link>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                {{ __('admin/dashboard.no_pending_adoptions') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">{{ $adoptionsPending->links() }}</div>
        </x-dashboard.section>
    @endcan

    @can('manage-messages')
        <x-dashboard.section title="{{ __('admin/dashboard.unread_messages') }}" term="messageSearch" placeholder="{{ __('admin/dashboard.search_name_subject_placeholder') }}">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.from') }}</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.subject') }}</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($messagesUnread as $message)
                        <tr wire:key="message-{{ $message->id }}">
                            <td class="py-2 font-sans text-blue-strong">{{ $message->name }}</td>
                            <td class="py-2 font-sans text-blue-strong/70">{{ $message->subject ?? '-' }}</td>
                            <td class="py-2 text-right flex items-center justify-end gap-4">
                                <x-admin-link :href="route('admin.messages.show', ['locale' => app()->getLocale(), 'message' => $message])"
                                   class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                                    {{ __('admin/common.view') }}
                                </x-admin-link>
                                <a href="mailto:{{ $message->email }}"
                                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                    {{ __('admin/common.reply') }}
                                </a>
                                @can('delete', $message)
                                    <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $message->id }}', model_type: 'message' } })"
                                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                        {{ __('admin/common.delete') }}
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                {{ __('admin/dashboard.no_unread_messages') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">{{ $messagesUnread->links() }}</div>
        </x-dashboard.section>
    @endcan

    @can('manage-volunteers')
        <x-dashboard.section title="{{ __('admin/dashboard.unread_applications') }}" term="applicationSearch" placeholder="{{ __('admin/dashboard.search_name_placeholder') }}">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.name') }}</th>
                        <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/dashboard.email') }}</th>
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
                                    {{ __('admin/common.view') }}
                                </x-admin-link>
                                @can('create', \App\Models\User::class)
                                    <x-admin-link :href="route('admin.volunteers.create', ['locale' => app()->getLocale()])"
                                       class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                        {{ __('admin/common.create_account') }}
                                    </x-admin-link>
                                @endcan
                                <a href="mailto:{{ $application->email }}"
                                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                                    {{ __('admin/common.reply') }}
                                </a>
                                @can('delete', $application)
                                    <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $application->id }}', model_type: 'volunteer-application' } })"
                                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                        {{ __('admin/common.delete') }}
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center font-sans text-blue-strong/70">
                                {{ __('admin/dashboard.no_unread_applications') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">{{ $applicationsUnread->links() }}</div>
        </x-dashboard.section>
    @endcan
</div>
