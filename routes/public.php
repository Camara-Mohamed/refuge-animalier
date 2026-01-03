<?php

use App\Http\Controllers\AnimalController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')->middleware(SetLocale::class)->group(function (){
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/animals', [AnimalController::class, 'index'])
        ->name('public.animals.index');

    Route::get('/about', function () {
        return view('public.about');
    })->name('public.about');

    Route::get('/contact', function () {
        return view('public.contact');
    })->name('public.contact');

    Route::get('/volunteer', function () {
        return view('public.volunteer');
    })->name('public.volunteer');
});
