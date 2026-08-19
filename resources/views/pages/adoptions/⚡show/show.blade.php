<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.adoptions'), 'url' => route('admin.adoptions.index', ['locale' => app()->getLocale()])],
        ['label' => $adoption->adopter->name, 'url' => '#'],
    ]" :key="'adoption-show-breadcrumb'" />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-2">
            <h1 class="font-serif font-bold text-2xl text-blue-strong">
                {{ $adoption->adopter->name }} → {{ $adoption->animal->name }}
            </h1>
            <x-badge :color="$adoption->status->color()">{{ $adoption->status->label() }}</x-badge>
        </div>

        @can('delete', $adoption)
            <button wire:click="delete" wire:confirm="Supprimer cette demande ? Cette action est irréversible."
                    class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                Supprimer
            </button>
        @endcan
    </div>

    <ul class="flex flex-col gap-1 font-sans text-sm text-blue-strong">
        <li>Email : {{ $adoption->adopter->email }}</li>
        <li>Téléphone : {{ $adoption->adopter->phone }}</li>
        <li>Adresse : {{ $adoption->adopter->address }} {{ $adoption->adopter->number }}, {{ $adoption->adopter->city }} {{ $adoption->adopter->postal_code }}</li>
        <li>Type de logement : {{ $adoption->adopter->house_type->label() }}</li>
        <li>A un jardin : {{ $adoption->adopter->have_garden ? 'Oui' : 'Non' }}</li>
        <li>Demandée le : {{ $adoption->created_at->format('d/m/Y H:i') }}</li>
    </ul>

    @if ($adoption->message)
        <div class="flex flex-col gap-1">
            <span class="font-sans text-sm text-blue-strong/60">Message</span>
            <p class="font-sans text-blue-strong whitespace-pre-line">{{ $adoption->message }}</p>
        </div>
    @endif

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
        <p class="font-sans text-sm text-blue-strong/50">Seul un administrateur peut changer le statut de cette demande.</p>
    @endcan

    <div class="flex flex-col gap-2">
        <h3 class="font-serif font-bold text-lg text-blue-strong">Notes</h3>

        <ul class="flex flex-col gap-3">
            @forelse ($notes as $note)
                <li wire:key="note-{{ $note->id }}" class="flex items-start justify-between gap-4 p-3 rounded-lg bg-blue-strong/5">
                    <div>
                        <p class="font-sans text-sm text-blue-strong">{{ $note->content }}</p>
                        <p class="font-sans text-xs text-blue-strong/50 mt-1">
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
