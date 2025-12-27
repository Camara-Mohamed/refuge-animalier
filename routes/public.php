<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'fr');

Route::prefix('{locale}')->middleware(SetLocale::class)->group(function (){
    Route::get('/'.__('public/routes.home'), function () {
        return view('home');
    })->name('home');

    Route::get('/'.__('public/routes.animals'), function () {
        return view('public.animals.index');
    })->name('public.animals.index');

    Route::get('/'.__('public/routes.about'), function () {
        return view('public.about');
    })->name('public.about');

    Route::get('/'.__('public/routes.contact'), function () {
        return view('public.contact');
    })->name('public.contact');
});
