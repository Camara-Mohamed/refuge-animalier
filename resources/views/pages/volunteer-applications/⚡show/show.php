<?php

use App\Models\VolunteerApplication;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Candidature bénévole')] class extends Component
{
    public VolunteerApplication $application;

    public function mount(VolunteerApplication $volunteerApplication): void
    {
        $this->authorize('view', $volunteerApplication);

        $volunteerApplication->markAsRead();

        $this->application = $volunteerApplication;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->application);

        $this->application->delete();

        session()->flash('success', __('modals.volunteer-application.deleted'));

        $this->redirectRoute('admin.volunteer-applications.index', ['locale' => app()->getLocale()]);
    }

    #[On('volunteer-application_delete_confirmed')]
    public function onVolunteerApplicationDeleteConfirmed(): void
    {
        $this->delete();
    }
};
