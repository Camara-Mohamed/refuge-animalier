<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Component Namespaces
    |--------------------------------------------------------------------------
    |
    | Maps a namespace prefix (used as `namespace::component` in
    | Route::livewire()/<livewire:namespace::component />) to the directory
    | where its single/multi-file components live.
    |
    */

    'component_namespaces' => [
        'pages' => resource_path('views/pages'),
        'layouts' => resource_path('views/layouts'),
        'widgets' => resource_path('views/widgets'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Component Layout
    |--------------------------------------------------------------------------
    |
    | Default layout wrapping every full-page Livewire component (admin and
    | volunteer areas). See resources/views/layouts/app.blade.php.
    |
    */

    'component_layout' => 'layouts::app',

];
