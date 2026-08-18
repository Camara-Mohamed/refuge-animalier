<?php

use App\Mail\VolunteerAccountCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Créer un profil')] class extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|min:8')]
    public string $password = '';

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

    public function mount(): void
    {
        $this->authorize('create', User::class);
    }

    public function save(): void
    {
        $this->authorize('create', User::class);

        $data = $this->validate();
        unset($data['avatarFile']);

        $password = $data['password'];
        $data['password'] = bcrypt($password);

        if ($this->avatarFile) {
            $data['avatar'] = $this->avatarFile->store('avatars', 'public');
        }

        $volunteer = User::create($data);

        if ($volunteer->receive_emails) {
            Mail::to($volunteer)->send(new VolunteerAccountCreatedMail($volunteer, $password));
        }

        $this->redirectRoute('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $volunteer]);
    }
};
