<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.animals'), 'url' => route('admin.animals.index', ['locale' => app()->getLocale()])],
        ['label' => $animal->name, 'url' => '#'],
    ]" :key="'animals-show-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-2">
            <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ $animal->name }}</h2>
            <x-badge :color="$animal->status->color()">{{ $animal->status->label() }}</x-badge>
        </div>

        <div class="flex items-center gap-4">
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

    <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-4 max-w-2xl">
        @if ($animal->avatar)
            <img src="{{ $animal->avatarUrl(640) }}" srcset="{{ $animal->avatarSrcset() }}" sizes="250px"
                 alt="{{ $animal->name }}" width="250" class="rounded-lg" loading="lazy">
        @endif

        <x-data-row label="{{ __('admin/animals.show_gender') }}">{{ $animal->gender->label() }}</x-data-row>
        <x-data-row label="{{ __('admin/animals.show_age') }}">{{ $animal->age() !== null ? __('admin/animals.age_years', ['count' => $animal->age()]) : '-' }}</x-data-row>
        <x-data-row label="{{ __('admin/animals.chip') }}">{{ $animal->chip ?? '-' }}</x-data-row>
        <x-data-row label="{{ __('admin/animals.species') }}">{{ $animal->specie?->name ?? '-' }}</x-data-row>
        <x-data-row label="{{ __('admin/animals.race') }}">{{ $animal->race?->name ?? '-' }}</x-data-row>
        <x-data-row label="{{ __('admin/animals.coat') }}">{{ $animal->coat?->name ?? '-' }}</x-data-row>
        <x-data-row label="{{ __('admin/animals.added_by') }}">{{ $animal->user?->fullName() ?? '-' }}</x-data-row>

        @if ($animal->description)
            <hr class="border-red-strong/20">

            <div class="flex flex-col gap-1">
                <span class="font-sans font-bold text-blue-strong">{{ __('admin/animals.description') }}</span>
                <p class="font-sans text-blue-strong whitespace-pre-line">{{ $animal->description }}</p>
            </div>
        @endif
    </div>

    @can('update', $animal)
        <div class="flex flex-col gap-2 max-w-2xl">
            <span class="font-serif font-semibold text-blue-strong">{{ __('admin/animals.change_status') }}</span>
            <div class="flex flex-wrap gap-2">
                @foreach (\App\Enums\AnimalStatus::cases() as $status)
                    <button wire:click="changeStatus('{{ $status->value }}')"
                            class="px-4 py-2 rounded-lg border font-sans text-sm transition-colors cursor-pointer
                                {{ $status === $animal->status ? 'bg-red-strong border-red-strong text-white' : 'border-gray-300 text-blue-strong hover:bg-red-light' }}">
                        {{ $status->label() }}
                    </button>
                @endforeach
            </div>
        </div>
    @endcan

    <div class="flex flex-col gap-2 max-w-2xl">
        <h2 class="font-serif font-bold text-lg text-blue-strong">{{ __('admin/animals.notes') }}</h2>

        <ul class="flex flex-col gap-3">
            @forelse ($notes as $note)
                <li wire:key="note-{{ $note->id }}" class="flex items-start justify-between gap-4 p-3 rounded-lg bg-blue-strong/5">
                    <div>
                        <p class="font-sans text-sm text-blue-strong">{{ $note->content }}</p>
                        <p class="font-sans text-xs text-blue-strong/70 mt-1">
                            {{ $note->user?->fullName() ?? '-' }} · {{ $note->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    @can('delete', $note)
                        <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $note->id }}', model_type: 'animal-note' } })"
                                class="shrink-0 font-sans text-sm text-red-normal hover:text-red-strong cursor-pointer">
                            {{ __('admin/common.delete') }}
                        </button>
                    @endcan
                </li>
            @empty
                <li class="font-sans text-sm text-blue-strong/40">{{ __('admin/animals.no_notes_yet') }}</li>
            @endforelse
        </ul>

        @can('create', \App\Models\Note::class)
            <form wire:submit="addNote" class="flex flex-col gap-2">
                <textarea wire:model="newNote" placeholder="{{ __('admin/animals.add_note_placeholder') }}" rows="3"
                          class="w-full px-4 py-2 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong"></textarea>
                @error('newNote') <p class="font-sans text-sm text-red-normal">{{ $message }}</p> @enderror
                <button type="submit"
                        class="self-end px-4 py-2 rounded-lg font-sans font-bold text-sm text-white bg-red-strong hover:bg-red-normal cursor-pointer">
                    {{ __('admin/animals.add_note') }}
                </button>
            </form>
        @endcan
    </div>
</div>
