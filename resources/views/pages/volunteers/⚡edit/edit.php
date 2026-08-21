<?php

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Modifier un profil')] class extends Component
{
    use WithFileUploads;

    public User $volunteer;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|in:admin,volunteer')]
    public string $role = 'volunteer';

    #[Validate('nullable|string')]
    public ?string $phone = null;

    #[Validate('nullable|string')]
    public ?string $address = null;

    #[Validate('nullable|string')]
    public ?string $number = null;

    #[Validate('nullable|string')]
    public ?string $city = null;

    #[Validate('nullable|string')]
    public ?string $code_postal = null;

    #[Validate('nullable|image|max:2048')]
    public $avatarFile = null;

    public function mount(User $volunteer): void
    {
        $this->authorize('update', $volunteer);

        $this->volunteer = $volunteer;

        if ($volunteer->id === auth()->id()) {
            $this->redirectRoute('admin.profile', ['locale' => app()->getLocale()]);

            return;
        }

        $this->name = $volunteer->name;
        $this->email = $volunteer->email;
        $this->role = $volunteer->role->value;
        $this->phone = $volunteer->phone;
        $this->address = $volunteer->address;
        $this->number = $volunteer->number;
        $this->city = $volunteer->city;
        $this->code_postal = $volunteer->code_postal;
    }

    public function save(): void
    {
        $this->authorize('update', $this->volunteer);

        $data = $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->volunteer->id)],
            'role' => 'required|in:admin,volunteer',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'number' => 'nullable|string',
            'city' => 'nullable|string',
            'code_postal' => 'nullable|string',
            'avatarFile' => 'nullable|image|max:2048',
        ]);
        unset($data['avatarFile']);

        if ($this->avatarFile) {
            $data['avatar'] = $this->avatarFile->store('avatars', config('filesystems.default'));
        }

        $this->volunteer->update($data);

        $this->redirectRoute('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $this->volunteer]);
    }
};
