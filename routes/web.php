<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/public.php';

Route::get('/', function () {
    return redirect('/fr');
});
