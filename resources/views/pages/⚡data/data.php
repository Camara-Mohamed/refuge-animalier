<?php

use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('Données')] class extends Component
{
    #[Validate('required|string|max:255')]
    public string $newSpecie = '';

    #[Validate('required|string|max:255')]
    public string $newRace = '';

    #[Validate('required|exists:species,id')]
    public ?int $newRaceSpecieId = null;

    #[Validate('required|string|max:255')]
    public string $newCoat = '';

    public function addSpecie(): void
    {
        $this->authorize('create', Specie::class);
        $this->validateOnly('newSpecie');

        Specie::create(['name' => $this->newSpecie]);

        $this->reset('newSpecie');
    }

    public function deleteSpecie(Specie $specie): void
    {
        $this->authorize('delete', $specie);

        $specie->delete();
    }

    public function addRace(): void
    {
        $this->authorize('create', Race::class);

        $this->validate([
            'newRace' => 'required|string|max:255',
            'newRaceSpecieId' => 'required|exists:species,id',
        ]);

        Race::create([
            'name' => $this->newRace,
            'specie_id' => $this->newRaceSpecieId,
        ]);

        $this->reset('newRace', 'newRaceSpecieId');
    }

    public function deleteRace(Race $race): void
    {
        $this->authorize('delete', $race);

        $race->delete();
    }

    public function addCoat(): void
    {
        $this->authorize('create', Coat::class);
        $this->validateOnly('newCoat');

        Coat::create(['name' => $this->newCoat]);

        $this->reset('newCoat');
    }

    public function deleteCoat(Coat $coat): void
    {
        $this->authorize('delete', $coat);

        $coat->delete();
    }

    public function with(): array
    {
        return [
            'species' => Specie::orderBy('name')->get(),
            'races' => Race::with('specie')->orderBy('name')->get(),
            'coats' => Coat::orderBy('name')->get(),
        ];
    }
};
