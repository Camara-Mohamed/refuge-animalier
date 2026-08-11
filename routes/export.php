<?php

use App\Http\Controllers\ReportController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}/admin/reports')
    ->middleware([SetLocale::class, 'auth', 'can:manage-reports'])
    ->group(function () {
        Route::get('/{month}/{year}/download', [ReportController::class, 'exportPdf'])
            ->whereNumber(['month', 'year'])
            ->name('admin.reports.download');
    });
