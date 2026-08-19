<?php

use App\Enums\AdoptionStatus;
use App\Mail\AdoptionStatusUpdatedMail;
use App\Models\Adoption;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Adoptions')] class extends Component
{
    use WithPagination;

    public string $statusFilter = '';

    public function mount(): void
    {
        $this->authorize('viewAny', Adoption::class);
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function changeStatus(Adoption $adoption, string $status): void
    {
        $this->authorize('changeStatus', $adoption);

        $adoption->update(['status' => AdoptionStatus::from($status)]);

        if (in_array($adoption->status, [AdoptionStatus::ACCEPTED, AdoptionStatus::REJECTED])) {
            Mail::to($adoption->adopter->email)->send(new AdoptionStatusUpdatedMail($adoption));
        }
    }

    public function delete(Adoption $adoption): void
    {
        $this->authorize('delete', $adoption);

        $adoption->delete();
    }

    public function with(): array
    {
        $adoptions = Adoption::query()
            ->with(['adopter', 'animal'])
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(10);

        return [
            'adoptions' => $adoptions,
        ];
    }
};
