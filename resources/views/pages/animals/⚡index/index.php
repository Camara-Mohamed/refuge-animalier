<?php

use App\Models\Animal;
use App\Models\Specie;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    public string $specieFilter = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingSpecieFilter(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $animals = Animal::query()
            ->with(['specie'])
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->specieFilter, fn ($q) => $q->where('specie_id', $this->specieFilter))
            ->latest()
            ->paginate(10);

        return [
            'animals' => $animals,
            'species' => Specie::orderBy('name')->get(),
        ];
    }
};
