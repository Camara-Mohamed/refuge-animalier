<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware('role:admin')->group(function () {

        Route::livewire('/', 'admin::dashboard')->name('admin.dashboard');

        Route::livewire('/animals', 'admin::animals.index')->name('admin.animals.index');
        Route::livewire('/animals/create', 'admin::animals.create')->name('admin.animals.create');
        Route::livewire('/animals/{animal}', 'admin::animals.show')->name('admin.animals.show');
        Route::livewire('/animals/{animal}/edit', 'admin::animals.edit')->name('admin.animals.edit');
    });

    Route::prefix('admin/volunteer')->middleware('role:volunteer')->group(function () {

        Route::livewire('/', 'volunteer::dashboard')->name('volunteer.dashboard');

        Route::livewire('/animals', 'volunteer::animals.index')->name('volunteer.animals.index');
        Route::livewire('/animals/create', 'volunteer::animals.create')->name('volunteer.animals.create');
        Route::livewire('/animals/{animal}', 'volunteer::animals.show')->name('volunteer.animals.show');
        Route::livewire('/animals/{animal}/edit', 'volunteer::animals.edit')->name('volunteer.animals.edit');
    });

});
