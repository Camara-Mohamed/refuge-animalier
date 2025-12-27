<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'fr');

Route::prefix('{locale}')->middleware(SetLocale::class)->group(function (){
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/nos-animaux', function () {
        return view('public.animals.index');
    })->name('public.animals.index');

    Route::get('/a-propos', function () {
        return view('public.about');
    })->name('public.about');

    Route::get('/nous-contacter', function () {
        return view('public.contact');
    })->name('public.contact');
});
