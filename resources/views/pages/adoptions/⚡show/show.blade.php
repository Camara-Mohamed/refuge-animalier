<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.adoptions'), 'url' => route('admin.adoptions.index', ['locale' => app()->getLocale()])],
        ['label' => $adoption->adopter->name, 'url' => '#'],
    ]" :key="'adoption-show-breadcrumb'" />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-2">
            <div>
                <h1 class="font-serif font-bold text-2xl text-blue-strong">
                    {{ $adoption->adopter->name }} → {{ $adoption->animal->name }}
                </h1>
                <p class="font-sans text-sm text-blue-strong/70">Demandée le {{ $adoption->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <x-badge :color="$adoption->status->color()">{{ $adoption->status->label() }}</x-badge>
        </div>

        @can('delete', $adoption)
            <button wire:click="delete" wire:confirm="Supprimer cette demande ? Cette action est irréversible."
                    class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                Supprimer
            </button>
        @endcan
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
        <div class="p-6 bg-white rounded-2xl border border-blue-turquoise flex flex-col gap-4">
            <h2 class="font-serif font-bold text-xl text-blue-strong">Animal</h2>
            <hr class="border-blue-turquoise">

            <x-data-row label="Nom">{{ $adoption->animal->name }}</x-data-row>

            @if ($adoption->animal->specie)
                <x-data-row label="Espèce">{{ $adoption->animal->specie->name }}</x-data-row>
            @endif

            @if ($adoption->animal->race)
                <x-data-row label="Race">{{ $adoption->animal->race->name }}</x-data-row>
            @endif

            @if ($adoption->animal->birth_date)
                <x-data-row label="Âge">{{ \Carbon\Carbon::parse($adoption->animal->birth_date)->age }} ans</x-data-row>
            @endif

            @if ($adoption->animal->coat)
                <x-data-row label="Pelage">{{ $adoption->animal->coat->name }}</x-data-row>
            @endif

            @if ($adoption->animal->specie?->vaccines->isNotEmpty())
                <x-data-row label="Vaccins">{{ $adoption->animal->specie->vaccines->pluck('name')->join(' / ') }}</x-data-row>
            @endif

            <hr class="border-blue-turquoise">

            <x-data-row label="Statut de l'animal">
                <x-badge :color="$adoption->animal->status->color()">{{ $adoption->animal->status->label() }}</x-badge>
            </x-data-row>
        </div>

        <div class="p-6 bg-white rounded-2xl border border-blue-turquoise flex flex-col gap-4">
            <h2 class="font-serif font-bold text-xl text-blue-strong">Adoptant</h2>
            <hr class="border-blue-turquoise">

            <x-data-row label="Nom">{{ $adoption->adopter->name }}</x-data-row>
            <x-data-row label="Email">{{ $adoption->adopter->email }}</x-data-row>
            <x-data-row label="Téléphone">{{ $adoption->adopter->phone }}</x-data-row>

            <hr class="border-blue-turquoise">

            <x-data-row label="Adresse">{{ $adoption->adopter->address }} {{ $adoption->adopter->number }}, {{ $adoption->adopter->postal_code }} {{ $adoption->adopter->city }}</x-data-row>
            <x-data-row label="Logement">{{ $adoption->adopter->house_type->label() }}</x-data-row>
            <x-data-row label="Jardin">{{ $adoption->adopter->have_garden ? 'Oui' : 'Non' }}</x-data-row>

            @if ($adoption->message)
                <hr class="border-blue-turquoise">

                <div class="flex flex-col gap-1">
                    <span class="font-sans font-bold text-blue-strong">Motivation</span>
                    <p class="font-sans text-blue-strong whitespace-pre-line">{{ $adoption->message }}</p>
                </div>
            @endif
        </div>
    </div>

    @can('changeStatus', $adoption)
        <div class="flex items-center gap-2">
            <x-forms.select for="newStatus" id="adoption-status-select" label_title="Changer le statut">
                @foreach (\App\Enums\AdoptionStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected($status === $adoption->status)>{{ $status->label() }}</option>
                @endforeach
            </x-forms.select>
            <button type="button"
                    onclick="$wire.changeStatus(document.getElementById('adoption-status-select').value)"
                    class="font-sans text-sm font-semibold text-white bg-blue-strong px-4 py-2 rounded-lg hover:bg-blue-strong/80 cursor-pointer">
                Changer
            </button>
        </div>
    @else
        <p class="font-sans text-sm text-blue-strong/70">Seul un administrateur peut changer le statut de cette demande.</p>
    @endcan

    <div class="flex flex-col gap-2">
        <h3 class="font-serif font-bold text-lg text-blue-strong">Notes</h3>

        <ul class="flex flex-col gap-3">
            @forelse ($notes as $note)
                <li wire:key="note-{{ $note->id }}" class="flex items-start justify-between gap-4 p-3 rounded-lg bg-blue-strong/5">
                    <div>
                        <p class="font-sans text-sm text-blue-strong">{{ $note->content }}</p>
                        <p class="font-sans text-xs text-blue-strong/70 mt-1">
                            {{ $note->user?->fullName() ?? '—' }} · {{ $note->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    @can('delete', $note)
                        <button wire:click="deleteNote({{ $note->id }})" wire:confirm="Supprimer cette note ?"
                                class="shrink-0 font-sans text-sm text-red-normal hover:text-red-strong cursor-pointer">
                            Supprimer
                        </button>
                    @endcan
                </li>
            @empty
                <li class="font-sans text-sm text-blue-strong/40">Pas encore de note.</li>
            @endforelse
        </ul>

        @can('create', \App\Models\Note::class)
            <form wire:submit="addNote" class="flex flex-col gap-2">
                <textarea wire:model="newNote" placeholder="Ajouter une note..." rows="3"
                          class="w-full px-4 py-2 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong"></textarea>
                @error('newNote') <p class="font-sans text-sm text-red-normal">{{ $message }}</p> @enderror
                <button type="submit"
                        class="self-end px-4 py-2 rounded-lg font-sans font-bold text-sm text-white bg-red-strong hover:bg-red-normal cursor-pointer">
                    Ajouter une note
                </button>
            </form>
        @endcan
    </div>
</div>
