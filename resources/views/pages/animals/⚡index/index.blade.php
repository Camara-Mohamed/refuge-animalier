<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.animals'), 'url' => route('admin.animals.index', ['locale' => app()->getLocale()])],
    ]" :key="'animals-index-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ __('admin/animals.index_title') }}</h2>
    </div>

    <div class="flex items-start gap-4 flex-wrap">
        <x-forms.input for="search" type="text" placeholder="{{ __('admin/animals.search_name_placeholder') }}"
                        wire:model.live.debounce.300ms="search" class="w-64">
            <span class="sr-only">{{ __('admin/common.search') }}</span>
        </x-forms.input>

        <x-filter-panel>
            <x-forms.select for="statusFilter" wire:model.live="statusFilter" label_title="{{ __('admin/animals.filter_status') }}">
                <option value="">{{ __('admin/animals.all_statuses') }}</option>
                @foreach (\App\Enums\AnimalStatus::cases() as $status)
                    <option value="{{ $status->value }}">{{ $status->label() }}</option>
                @endforeach
            </x-forms.select>

            <x-forms.select for="specieFilter" wire:model.live="specieFilter" label_title="{{ __('admin/animals.filter_species') }}">
                <option value="">{{ __('admin/animals.all_species') }}</option>
                @foreach ($species as $specie)
                    <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                @endforeach
            </x-forms.select>
        </x-filter-panel>

        @can('create', \App\Models\Animal::class)
            <x-admin-link :href="route('admin.animals.create', ['locale' => app()->getLocale()])"
                          class="px-4 h-[50px] rounded-lg bg-red-strong text-white font-sans text-sm font-semibold
                          hover:bg-red-normal flex items-center justify-center">
                {{ __('admin/animals.add_animal') }}
            </x-admin-link>
        @endcan
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($animals as $animal)
            <div wire:key="animal-{{ $animal->id }}"
                 class="p-2 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border-b-4 border-red-strong flex flex-col gap-2">
                <div class="h-48 rounded-lg overflow-hidden">
                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $animal->avatarUrl(640) }}');"
                         role="img" aria-label="{{ __('admin/animals.photo_alt', ['name' => $animal->name]) }}"></div>
                </div>

                <div class="px-2 pb-2 flex flex-col gap-2">
                    <div class="flex justify-between items-start gap-2">
                        <div>
                            <h2 class="font-serif font-bold text-lg text-blue-strong">{{ $animal->name }}</h2>
                            <p class="font-sans text-sm text-blue-strong/70">{{ $animal->specie?->name ?? '-' }}</p>
                        </div>

                        @can('update', $animal)
                            <select wire:change="changeStatus({{ $animal->id }}, $event.target.value)"
                                    class="shrink-0 px-2 py-1 rounded-lg border border-gray-200 font-sans text-xs text-blue-strong focus:outline-none focus:border-red-strong">
                                @foreach (\App\Enums\AnimalStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($status === $animal->status)>{{ $status->label() }}</option>
                                @endforeach
                            </select>
                        @else
                            <x-badge :color="$animal->status->color()">{{ $animal->status->label() }}</x-badge>
                        @endcan
                    </div>

                    <div class="flex items-center gap-4 pt-2 border-t border-red-strong/10">
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
                    </div>
                </div>
            </div>
        @empty
            <p class="font-sans text-blue-strong/70">{{ __('admin/animals.no_animals_found') }}</p>
        @endforelse
    </div>

    <div>
        {{ $animals->links() }}
    </div>
</div>
