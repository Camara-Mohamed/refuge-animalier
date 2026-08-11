<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function exportPdf(string $month, string $year): Response
    {
        $pdf = Pdf::loadView('pdf.report', [
            'month' => $month,
            'year' => $year,
        ]);

        return $pdf->download("rapport-{$year}-{$month}.pdf");
    }
}
