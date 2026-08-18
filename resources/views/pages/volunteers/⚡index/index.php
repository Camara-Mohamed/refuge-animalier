<?php

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Bénévoles')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public string $roleFilter = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingRoleFilter(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $volunteers = User::query()
            ->where('id', '!=', auth()->id())
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            }))
            ->when($this->roleFilter, fn ($q) => $q->where('role', $this->roleFilter))
            ->orderBy('name')
            ->paginate(10);

        return [
            'volunteers' => $volunteers,
        ];
    }
};
