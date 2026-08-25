<?php

use App\Enums\UserRole;
use App\Mail\DeleteNotificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Fiche bénévole')] class extends Component
{
    public User $volunteer;

    public function mount(User $volunteer): void
    {
        $this->authorize('view', $volunteer);

        $this->volunteer = $volunteer;

        if ($volunteer->id === auth()->id()) {
            $this->redirectRoute('admin.profile', ['locale' => app()->getLocale()]);
        }
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->volunteer);

        $name = $this->volunteer->name;
        $this->volunteer->delete();

        $admins = User::where('role', UserRole::ADMIN)
            ->where('id', '!=', auth()->id())
            ->where('receive_emails', true)
            ->get();

        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new DeleteNotificationMail('Profil bénévole', $name, auth()->user()->fullName()));
        }

        session()->flash('success', __('modals.volunteer.deleted'));

        $this->redirectRoute('admin.volunteers.index', ['locale' => app()->getLocale()]);
    }

    #[On('volunteer_delete_confirmed')]
    public function onVolunteerDeleteConfirmed(): void
    {
        $this->delete();
    }
};
