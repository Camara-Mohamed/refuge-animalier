<?php

use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use App\Mail\NewAnimalMail;
use App\Models\Animal;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use App\Models\User;
use App\Traits\HandlesAnimalAvatar;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Ajouter un animal')] class extends Component
{
    use HandlesAnimalAvatar, WithFileUploads;

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
            $data['avatar'] = $this->storeAnimalAvatar($this->avatarFile);
        }

        $animal = Animal::create($data);

        if (auth()->user()->isVolunteer()) {
            $admins = User::where('role', UserRole::ADMIN)->where('receive_emails', true)->get();
            if ($admins->isNotEmpty()) {
                Mail::to($admins)->send(new NewAnimalMail($animal));
            }
        }

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
