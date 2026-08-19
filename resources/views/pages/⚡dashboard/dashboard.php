<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\Month;
use App\Enums\UserRole;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Message;
use App\Models\User;
use App\Models\VolunteerApplication;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tableau de bord')] class extends Component
{
    public string $selectedMonth = '';

    public array $months = [];

    public function mount(): void
    {
        $currentMonth = now()->startOfMonth();

        for ($i = 0; $i < 12; $i++) {
            $date = $currentMonth->copy()->subMonths($i);

            $month = Month::from($date->month);
            $label = $month->label().' '.$date->year;

            $value = $date->format('Y-m');

            $this->months[] = [
                'label' => $label,
                'value' => $value,
            ];
        }
    }

    public function with(): array
    {
        $stats = [];

        $hasMonth = $this->selectedMonth !== '';
        $monthStart = null;
        $monthEnd = null;

        if ($hasMonth) {
            $monthStart = Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
            $monthEnd = $monthStart->copy()->endOfMonth();
        }

        if (auth()->user()->can('manage-animals')) {
            if ($hasMonth) {
                $stats['animals_total'] = Animal::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            } else {
                $stats['animals_total'] = Animal::count();
            }

            $stats['animals_adoptable'] = Animal::where('status', AnimalStatus::ADOPTABLE)->count();
        }

        if (auth()->user()->can('manage-adoptions')) {
            $stats['adoptions_pending'] = Adoption::whereIn('status', [AdoptionStatus::SUBMITTED, AdoptionStatus::QUEUE])->count();

            if ($hasMonth) {
                $stats['adoptions_completed'] = Adoption::where('status', AdoptionStatus::ACCEPTED)
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->count();
            } else {
                $stats['adoptions_completed'] = Adoption::where('status', AdoptionStatus::ACCEPTED)->count();
            }
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
