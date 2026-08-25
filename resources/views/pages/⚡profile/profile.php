<?php

use App\Enums\UserRole;
use App\Mail\ProfileUpdatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    #[Validate('nullable|string')]
    public ?string $address = null;

    #[Validate('nullable|string')]
    public ?string $number = null;

    #[Validate('nullable|string')]
    public ?string $city = null;

    #[Validate('nullable|string')]
    public ?string $code_postal = null;

    public bool $receive_emails = true;

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|min:8')]
    public string $password = '';

    #[Validate('nullable|image|max:2048')]
    public $avatarFile = null;

    public array $availabilities = [];

    public function mount(): void
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->address = $user->address;
        $this->number = $user->number;
        $this->city = $user->city;
        $this->code_postal = $user->code_postal;
        $this->receive_emails = $user->receive_emails;
        $this->email = $user->email;
        $this->availabilities = $user->availabilities ?? [];
    }

    protected function notifyAdmins(User $user): void
    {
        $admins = User::where('role', UserRole::ADMIN)
            ->where('id', '!=', $user->id)
            ->where('receive_emails', true)
            ->get();

        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new ProfileUpdatedMail($user));
        }
    }

    public function removeNewAvatar(): void
    {
        $this->reset('avatarFile');
    }

    public function saveAvatar(): void
    {
        $this->validate(['avatarFile' => 'nullable|image|max:2048']);

        if (! $this->avatarFile) {
            return;
        }

        $user = auth()->user();
        $user->update(['avatar' => $this->avatarFile->store('avatars', config('filesystems.default'))]);

        $this->reset('avatarFile');

        session()->flash('success_avatar', 'Photo de profil mise à jour avec succès !');
    }

    public function saveInfo(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'number' => 'nullable|string',
            'city' => 'nullable|string',
            'code_postal' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $this->name,
            'address' => $this->address,
            'number' => $this->number,
            'city' => $this->city,
            'code_postal' => $this->code_postal,
        ]);

        if ($user->wasChanged(['name', 'address', 'number', 'city', 'code_postal'])) {
            $this->notifyAdmins($user);
        }

        session()->flash('success_info', 'Informations mises à jour avec succès !');
    }

    public function saveNotifications(): void
    {
        $user = auth()->user();
        $user->update(['receive_emails' => $this->receive_emails]);

        if ($user->wasChanged('receive_emails')) {
            $this->notifyAdmins($user);
        }

        session()->flash('success_notifications', 'Préférences mises à jour avec succès !');
    }

    public function saveEmail(): void
    {
        $user = auth()->user();

        $this->validate([
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update(['email' => $this->email]);

        if ($user->wasChanged('email')) {
            $this->notifyAdmins($user);
        }

        session()->flash('success_email', 'Email mis à jour avec succès !');
    }

    public function savePassword(): void
    {
        $this->validate(['password' => 'required|string|min:8']);

        auth()->user()->update(['password' => Hash::make($this->password)]);

        $this->reset('password');

        session()->flash('success_password', 'Mot de passe mis à jour avec succès !');
    }

    public function saveAvailabilities(): void
    {
        $user = auth()->user();
        $user->update(['availabilities' => $this->availabilities]);

        if ($user->wasChanged('availabilities')) {
            $this->notifyAdmins($user);
        }

        session()->flash('success_availabilities', 'Disponibilités mises à jour avec succès !');
    }
};
