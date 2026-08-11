<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/public.php';
require __DIR__.'/admin.php';
require __DIR__.'/export.php';

Route::get('/', function () {
    return redirect('/fr');
});
