<?php

use App\Http\Controllers\AdopterController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\VolunteerController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')->middleware(SetLocale::class)->group(function (){
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/animals', [AnimalController::class, 'index'])
        ->name('public.animals.index');
    Route::get('/animals/{animal}', [AnimalController::class, 'show'])
        ->name('public.animals.show');
    Route::post('/animals/{animal}', [AdopterController::class, 'store'])
        ->name('public.animals.store');

    Route::get('/about', function () {
        return view('public.about');
    })->name('public.about');

    Route::get('/contact', function () {
        return view('public.contact');
    })->name('public.contact');
    Route::post('/contact', [MessageController::class, 'store'])
        ->name('public.contact.store');

    Route::get('/volunteer', [VolunteerController::class, 'index'])
        ->name('public.volunteer');
    Route::post('/volunteer', [VolunteerController::class, 'store'])
        ->name('public.volunteer.store');
});
