<?php

require __DIR__.'/public.php';

Route::get('/', function () {
    return redirect('/fr');
});
