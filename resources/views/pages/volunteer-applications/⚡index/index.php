<?php

use App\Models\VolunteerApplication;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Candidatures bénévoles')] class extends Component
{
    use WithPagination;

    public function mount(): void
    {
        $this->authorize('viewAny', VolunteerApplication::class);
    }

    public function delete(VolunteerApplication $volunteerApplication): void
    {
        $this->authorize('delete', $volunteerApplication);

        $volunteerApplication->delete();

        session()->flash('success', __('modals.volunteer-application.deleted'));
    }

    #[On('volunteer-application_delete_confirmed')]
    public function onVolunteerApplicationDeleteConfirmed(int $id): void
    {
        $this->delete(VolunteerApplication::findOrFail($id));
    }

    public function with(): array
    {
        return [
            'applications' => VolunteerApplication::query()->latest()->paginate(10),
        ];
    }
};
