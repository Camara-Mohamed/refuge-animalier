<?php

use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Mon profil')] class extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|image|max:2048')]
    public $avatarFile = null;

    public bool $receive_emails = true;

    public array $availabilities = [];

    public function mount(): void
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->receive_emails = auth()->user()->receive_emails;
        $this->availabilities = auth()->user()->availabilities ?? [];
    }

    public function removeNewAvatar(): void
    {
        $this->reset('avatarFile');
    }

    public function save(): void
    {
        $user = auth()->user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatarFile' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'receive_emails' => $this->receive_emails,
            'availabilities' => $this->availabilities,
        ];

        if ($this->avatarFile) {
            $data['avatar'] = $this->avatarFile->store('avatars', 'public');
        }

        $user->update($data);

        $this->reset('avatarFile');

        session()->flash('success', 'Profil mis à jour avec succès !');
    }
};
