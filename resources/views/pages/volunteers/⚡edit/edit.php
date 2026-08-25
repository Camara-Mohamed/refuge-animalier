<?php

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('Modifier un profil')] class extends Component
{
    public User $volunteer;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string')]
    public ?string $phone = null;

    #[Validate('required|in:admin,volunteer')]
    public string $role = 'volunteer';

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
        $this->phone = $volunteer->phone;
        $this->role = $volunteer->role->value;
    }

    public function save(): void
    {
        $this->authorize('update', $this->volunteer);

        $data = $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->volunteer->id)],
            'phone' => 'nullable|string',
            'role' => 'required|in:admin,volunteer',
        ]);

        $this->volunteer->update($data);

        $this->redirectRoute('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $this->volunteer]);
    }
};
