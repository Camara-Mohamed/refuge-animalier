<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')->middleware(SetLocale::class)->group(function () {
    Route::prefix('admin')->middleware(['auth'])->group(function () {

        // dashboard
        Route::livewire('/dashboard', 'pages::dashboard')->name('admin.dashboard');

        // les pages de gestion des animaux
        Route::livewire('/animals', 'pages::animals.index')
            ->middleware('can:manage-animals')
            ->name('admin.animals.index');
        Route::livewire('/animals/create', 'pages::animals.create')
            ->middleware('can:manage-animals')
            ->name('admin.animals.create');
        Route::livewire('/animals/{animal}', 'pages::animals.show')->name('admin.animals.show');
        Route::livewire('/animals/{animal}/edit', 'pages::animals.edit')->name('admin.animals.edit');

        // les demandes d'adoption
        Route::livewire('/adoptions', 'pages::adoptions.index')
            ->middleware('can:manage-adoptions')
            ->name('admin.adoptions.index');
        Route::livewire('/adoptions/{adoption}', 'pages::adoptions.show')->name('admin.adoptions.show');

        // la gestion des données
        Route::livewire('/data', 'pages::data')
            ->middleware('can:manage-data')
            ->name('admin.data.index');

        // les messages
        Route::livewire('/messages', 'pages::messages.index')
            ->middleware('can:manage-messages')
            ->name('admin.messages.index');
        Route::livewire('/messages/{message}', 'pages::messages.show')
            ->middleware('can:manage-messages')
            ->name('admin.messages.show');

        // la gestion des bénévoles
        Route::livewire('/volunteers', 'pages::volunteers.index')
            ->middleware('can:manage-volunteers')
            ->name('admin.volunteers.index');
        Route::livewire('/volunteers/create', 'pages::volunteers.create')
            ->middleware('can:manage-volunteers')
            ->name('admin.volunteers.create');
        Route::livewire('/volunteers/{volunteer}', 'pages::volunteers.show')
            ->middleware('can:manage-volunteers')
            ->name('admin.volunteers.show');
        Route::livewire('/volunteers/{volunteer}/edit', 'pages::volunteers.edit')
            ->middleware('can:manage-volunteers')
            ->name('admin.volunteers.edit');

        // les candidatures bénévoles
        Route::livewire('/volunteer-applications', 'pages::volunteer-applications.index')
            ->middleware('can:manage-volunteers')
            ->name('admin.volunteer-applications.index');
        Route::livewire('/volunteer-applications/{volunteerApplication}', 'pages::volunteer-applications.show')
            ->middleware('can:manage-volunteers')
            ->name('admin.volunteer-applications.show');

        // les statistiques
        /* Route::livewire('/reports', 'pages::reports')
            ->middleware('can:manage-reports')
            ->name('admin.reports.index'); */

        // le profil de l'utilisateur
        Route::livewire('/profile', 'pages::profile')->name('admin.profile');
    });
});
