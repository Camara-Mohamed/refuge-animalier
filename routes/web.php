<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/nos-animaux', function () {
    return view('public.animals.index');
})->name('public.animals.index');

Route::get('/about', function () {
    return view('public.about');
})->name('public.about');

Route::get('/nous-contacter', function () {
    return view('public.contact');
})->name('public.contact');
