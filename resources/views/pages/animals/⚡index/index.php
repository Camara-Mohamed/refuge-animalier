<?php

use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use App\Mail\AnimalStatusUpdatedMail;
use App\Mail\DeleteNotificationMail;
use App\Models\Animal;
use App\Models\Specie;
use App\Models\User;
use App\Traits\HandlesAnimalAvatar;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Animaux')] class extends Component
{
    use HandlesAnimalAvatar, WithPagination;

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

    public function changeStatus(Animal $animal, string $status): void
    {
        $this->authorize('update', $animal);

        $animal->update(['status' => AnimalStatus::from($status)]);

        $recipients = User::where('id', '!=', auth()->id())
            ->where('receive_emails', true)
            ->where(function ($query) use ($animal) {
                $query->where('role', UserRole::ADMIN)
                    ->orWhere('id', $animal->user_id);
            })
            ->get();

        if ($recipients->isNotEmpty()) {
            Mail::to($recipients)->send(new AnimalStatusUpdatedMail($animal));
        }
    }

    public function delete(Animal $animal): void
    {
        $this->authorize('delete', $animal);

        $name = $animal->name;
        $this->deleteAnimalAvatar($animal);
        $animal->delete();

        $admins = User::where('role', UserRole::ADMIN)
            ->where('id', '!=', auth()->id())
            ->where('receive_emails', true)
            ->get();

        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new DeleteNotificationMail('Animal', $name, auth()->user()->fullName()));
        }
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
