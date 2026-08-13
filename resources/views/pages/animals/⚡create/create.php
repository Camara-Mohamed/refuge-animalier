<?php

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|in:male,female')]
    public string $gender = '';

    #[Validate('nullable|date')]
    public ?string $birth_date = null;

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

    public function save(): void
    {
        $this->authorize('create', Animal::class);

        $data = $this->validate();
        unset($data['avatarFile']);

        $data['status'] = AnimalStatus::ADOPTABLE;
        $data['user_id'] = auth()->id();

        if ($this->avatarFile) {
            $data['avatar'] = $this->avatarFile->store('animals', 'public');
        }

        $animal = Animal::create($data);

        $this->redirectRoute('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal]);
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
