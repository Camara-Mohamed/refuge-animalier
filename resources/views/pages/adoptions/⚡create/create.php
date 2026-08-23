<?php

use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('Nouvelle adoption')] class extends Component
{
    #[Validate('required|exists:animals,id')]
    public ?int $animal_id = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $phone = '';

    #[Validate('required|string')]
    public string $address = '';

    #[Validate('required|string')]
    public string $number = '';

    #[Validate('required|string')]
    public string $city = '';

    #[Validate('required|string')]
    public string $postal_code = '';

    #[Validate('required')]
    public string $house_type = '';

    public bool $have_garden = false;

    #[Validate('required|string')]
    public string $message = '';

    public function save(): void
    {
        $this->authorize('create', Adoption::class);

        $data = $this->validate();

        $animalId = $data['animal_id'];
        unset($data['animal_id']);

        $adopter = Adopter::create($data);

        $adoption = Adoption::create([
            'adopter_id' => $adopter->id,
            'animal_id' => $animalId,
            'message' => $adopter->message,
            'user_id' => auth()->id(),
        ]);

        $this->redirectRoute('admin.adoptions.show', ['locale' => app()->getLocale(), 'adoption' => $adoption]);
    }

    public function with(): array
    {
        return [
            'animals' => Animal::orderBy('name')->get(),
        ];
    }
};
