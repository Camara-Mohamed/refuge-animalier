<?php

use App\Models\Animal;

it('gets the age from birth_date', function () {
    $animal = Animal::factory()->create(['birth_date' => now()->subYears(3)]);

    expect($animal->age())->toBe(3);
});
