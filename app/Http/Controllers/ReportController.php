<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\Month;
use App\Enums\UserRole;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Message;
use App\Models\User;
use App\Models\VolunteerApplication;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function exportPdf(string $month, string $year): Response
    {
        $start = Carbon::createFromDate((int) $year, (int) $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $stats = [];

        if (auth()->user()->can('manage-animals')) {
            $stats['Animaux ajoutés'] = Animal::whereBetween('created_at', [$start, $end])->count();
            $stats['Animaux adoptables'] = Animal::where('status', AnimalStatus::ADOPTABLE)->count();
        }

        if (auth()->user()->can('manage-adoptions')) {
            $stats['Adoptions en attente'] = Adoption::whereIn('status', [AdoptionStatus::SUBMITTED, AdoptionStatus::QUEUE])->count();
            $stats['Adoptions réussies'] = Adoption::where('status', AdoptionStatus::ACCEPTED)
                ->whereBetween('created_at', [$start, $end])->count();
        }

        if (auth()->user()->can('manage-messages')) {
            $stats['Messages non lus'] = Message::whereNull('read_at')->count();
        }

        if (auth()->user()->can('manage-volunteers')) {
            $stats['Bénévoles'] = User::where('role', UserRole::VOLUNTEER)->count();
            $stats['Candidatures non lues'] = VolunteerApplication::whereNull('read_at')->count();
        }

        $monthLabel = Month::from($start->month)->label().' '.$start->year;

        $pdf = Pdf::loadView('pdf.report', [
            'month' => $monthLabel,
            'stats' => $stats,
        ]);

        return $pdf->download("rapport-{$year}-{$month}.pdf");
    }
}
