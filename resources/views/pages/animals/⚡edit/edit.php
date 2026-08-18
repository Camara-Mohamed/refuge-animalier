<?php

use App\Models\Animal;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Modifier un animal')] class extends Component
{
    use WithFileUploads;

    public Animal $animal;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $description = null;

    #[Validate('nullable|exists:species,id')]
    public ?int $specie_id = null;

    #[Validate('nullable|exists:races,id')]
    public ?int $race_id = null;

    #[Validate('nullable|exists:coats,id')]
    public ?int $coat_id = null;

    #[Validate('nullable|image|max:4096')]
    public $avatarFile = null;

    public function mount(Animal $animal): void
    {
        $this->authorize('update', $animal);

        $this->animal = $animal;
        $this->name = $animal->name;
        $this->description = $animal->description;
        $this->specie_id = $animal->specie_id;
        $this->race_id = $animal->race_id;
        $this->coat_id = $animal->coat_id;
    }

    public function save(): void
    {
        $this->authorize('update', $this->animal);

        $data = $this->validate();
        unset($data['avatarFile']);

        if ($this->avatarFile) {
            $data['avatar'] = $this->avatarFile->store('animals', 'public');
        }

        $this->animal->update($data);

        $this->redirectRoute('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $this->animal]);
    }

    public function with(): array
    {
        return [
            'species' => Specie::orderBy('name')->get(),
            'races' => Race::orderBy('name')->get(),
            'coats' => Coat::orderBy('name')->get(),
        ];
    }
};
