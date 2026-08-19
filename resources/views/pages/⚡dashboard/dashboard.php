<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Message;
use App\Models\User;
use App\Models\VolunteerApplication;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tableau de bord')] class extends Component
{
    public function with(): array
    {
        $stats = [];

        if (auth()->user()->can('manage-animals')) {
            $stats['animals_total'] = Animal::count();
            $stats['animals_adoptable'] = Animal::where('status', AnimalStatus::ADOPTABLE)->count();
        }

        if (auth()->user()->can('manage-adoptions')) {
            $stats['adoptions_pending'] = Adoption::whereIn('status', [AdoptionStatus::SUBMITTED, AdoptionStatus::QUEUE])->count();
        }

        if (auth()->user()->can('manage-messages')) {
            $stats['messages_unread'] = Message::whereNull('read_at')->count();
        }

        if (auth()->user()->can('manage-volunteers')) {
            $stats['volunteers_total'] = User::where('role', UserRole::VOLUNTEER)->count();
            $stats['applications_unread'] = VolunteerApplication::whereNull('read_at')->count();
        }

        return ['stats' => $stats];
    }
};
