<?php

use App\Mail\VolunteerAccountCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('Créer un profil')] class extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('nullable|string')]
    public ?string $phone = null;

    #[Validate('required|in:admin,volunteer')]
    public string $role = 'volunteer';

    #[Validate('required|string|min:8')]
    public string $password = '';

    public function mount(): void
    {
        $this->authorize('create', User::class);
    }

    public function save(): void
    {
        $this->authorize('create', User::class);

        $data = $this->validate();

        $password = $data['password'];
        $data['password'] = bcrypt($password);

        $volunteer = User::create($data);

        if ($volunteer->receive_emails) {
            Mail::to($volunteer)->send(new VolunteerAccountCreatedMail($volunteer, $password));
        }

        $this->redirectRoute('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $volunteer]);
    }
};
