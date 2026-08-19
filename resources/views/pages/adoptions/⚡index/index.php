<?php

use App\Models\Adoption;
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
