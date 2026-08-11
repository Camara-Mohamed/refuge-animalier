<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animals.create')
        ->assertOk();
});
