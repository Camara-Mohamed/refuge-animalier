<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.adoptions'), 'url' => route('admin.adoptions.index', ['locale' => app()->getLocale()])],
        ['label' => $adoption->adopter->name, 'url' => '#'],
    ]" :key="'adoption-show-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-2">
            <div>
                <h2 class="font-serif font-bold text-2xl text-blue-strong">
                    {{ $adoption->adopter->name }} → {{ $adoption->animal->name }}
                </h2>
                <p class="font-sans text-sm text-blue-strong/70">{{ __('admin/adoptions.requested_on') }} {{ $adoption->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <x-badge :color="$adoption->status->color()">{{ $adoption->status->label() }}</x-badge>
        </div>

        @can('delete', $adoption)
            <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $adoption->id }}', model_type: 'adoption' } })"
                    class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                {{ __('admin/common.delete') }}
            </button>
        @endcan
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
        <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-4">
            <h2 class="font-serif font-bold text-xl text-blue-strong">{{ __('admin/adoptions.animal_section') }}</h2>
            <hr class="border-red-strong/20">

            <x-data-row label="{{ __('admin/adoptions.name') }}">{{ $adoption->animal->name }}</x-data-row>

            @if ($adoption->animal->specie)
                <x-data-row label="{{ __('admin/adoptions.species') }}">{{ $adoption->animal->specie->name }}</x-data-row>
            @endif

            @if ($adoption->animal->race)
                <x-data-row label="{{ __('admin/adoptions.race') }}">{{ $adoption->animal->race->name }}</x-data-row>
            @endif

            @if ($adoption->animal->birth_date)
                <x-data-row label="{{ __('admin/adoptions.age') }}">{{ __('admin/adoptions.age_years', ['count' => \Carbon\Carbon::parse($adoption->animal->birth_date)->age]) }}</x-data-row>
            @endif

            @if ($adoption->animal->coat)
                <x-data-row label="{{ __('admin/adoptions.coat') }}">{{ $adoption->animal->coat->name }}</x-data-row>
            @endif

            @if ($adoption->animal->specie?->vaccines->isNotEmpty())
                <x-data-row label="{{ __('admin/adoptions.vaccines') }}">{{ $adoption->animal->specie->vaccines->pluck('name')->join(' / ') }}</x-data-row>
            @endif

            <hr class="border-red-strong/20">

            <x-data-row label="{{ __('admin/adoptions.animal_status') }}">
                <x-badge :color="$adoption->animal->status->color()">{{ $adoption->animal->status->label() }}</x-badge>
            </x-data-row>
        </div>

        <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-4">
            <h2 class="font-serif font-bold text-xl text-blue-strong">{{ __('admin/adoptions.adopter_section') }}</h2>
            <hr class="border-red-strong/20">

            <x-data-row label="{{ __('admin/adoptions.name') }}">{{ $adoption->adopter->name }}</x-data-row>
            <x-data-row label="{{ __('admin/adoptions.email') }}">{{ $adoption->adopter->email }}</x-data-row>
            <x-data-row label="{{ __('admin/adoptions.phone') }}">{{ $adoption->adopter->phone }}</x-data-row>

            <hr class="border-red-strong/20">

            <x-data-row label="{{ __('admin/adoptions.address') }}">{{ $adoption->adopter->address }} {{ $adoption->adopter->number }}, {{ $adoption->adopter->postal_code }} {{ $adoption->adopter->city }}</x-data-row>
            <x-data-row label="{{ __('admin/adoptions.housing') }}">{{ $adoption->adopter->house_type->label() }}</x-data-row>
            <x-data-row label="{{ __('admin/adoptions.garden') }}">{{ $adoption->adopter->have_garden ? __('admin/adoptions.yes') : __('admin/adoptions.no') }}</x-data-row>

            @if ($adoption->message)
                <hr class="border-red-strong/20">

                <div class="flex flex-col gap-1">
                    <span class="font-sans font-bold text-blue-strong">{{ __('admin/adoptions.motivation') }}</span>
                    <p class="font-sans text-blue-strong whitespace-pre-line">{{ $adoption->message }}</p>
                </div>
            @endif
        </div>
    </div>

    @can('changeStatus', $adoption)
        <div class="flex items-center gap-2">
            <x-forms.select for="newStatus" id="adoption-status-select" label_title="{{ __('admin/adoptions.change_status') }}">
                @foreach (\App\Enums\AdoptionStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected($status === $adoption->status)>{{ $status->label() }}</option>
                @endforeach
            </x-forms.select>
            <button type="button"
                    onclick="$wire.changeStatus(document.getElementById('adoption-status-select').value)"
                    class="font-sans text-sm font-semibold text-white bg-blue-strong px-4 py-2 rounded-lg hover:bg-blue-strong/80 cursor-pointer">
                {{ __('admin/adoptions.change') }}
            </button>
        </div>
    @else
        <p class="font-sans text-sm text-blue-strong/70">{{ __('admin/adoptions.admin_only_status_change') }}</p>
    @endcan

    <div class="flex flex-col gap-2">
        <h3 class="font-serif font-bold text-lg text-blue-strong">{{ __('admin/adoptions.notes') }}</h3>

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
                        <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $note->id }}', model_type: 'adoption-note' } })"
                                class="shrink-0 font-sans text-sm text-red-normal hover:text-red-strong cursor-pointer">
                            {{ __('admin/common.delete') }}
                        </button>
                    @endcan
                </li>
            @empty
                <li class="font-sans text-sm text-blue-strong/40">{{ __('admin/adoptions.no_notes_yet') }}</li>
            @endforelse
        </ul>

        @can('create', \App\Models\Note::class)
            <form wire:submit="addNote" class="flex flex-col gap-2">
                <textarea wire:model="newNote" placeholder="{{ __('admin/adoptions.add_note_placeholder') }}" rows="3"
                          class="w-full px-4 py-2 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong"></textarea>
                @error('newNote') <p class="font-sans text-sm text-red-normal">{{ $message }}</p> @enderror
                <button type="submit"
                        class="self-end px-4 py-2 rounded-lg font-sans font-bold text-sm text-white bg-red-strong hover:bg-red-normal cursor-pointer">
                    {{ __('admin/adoptions.add_note') }}
                </button>
            </form>
        @endcan
    </div>
</div>
