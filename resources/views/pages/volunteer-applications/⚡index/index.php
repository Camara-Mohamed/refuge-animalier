<?php

use App\Models\VolunteerApplication;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Candidatures bénévoles')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    public function mount(): void
    {
        $this->authorize('viewAny', VolunteerApplication::class);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
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
        $applications = VolunteerApplication::query()
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            }))
            ->when($this->statusFilter === 'read', fn ($q) => $q->whereNotNull('read_at'))
            ->when($this->statusFilter === 'unread', fn ($q) => $q->whereNull('read_at'))
            ->latest()
            ->paginate(10);

        return [
            'applications' => $applications,
        ];
    }
};
