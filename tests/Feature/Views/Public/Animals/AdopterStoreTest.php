<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\House;
use App\Models\Adopter;
use App\Models\Adoption;
use App\Models\Animal;

it('creates an adopter and links an adoption request to the animal', function () {
    $animal = Animal::factory()->create(['status' => AnimalStatus::ADOPTABLE]);

    $response = $this->post(route('public.animals.store', ['locale' => 'fr', 'animal' => $animal]), [
        'name' => 'Igor Barrera',
        'email' => 'igor@example.com',
        'phone' => '0123456789',
        'address' => 'Rue des Fleurs',
        'number' => '12',
        'city' => 'Bruxelles',
        'postal_code' => '1000',
        'house_type' => House::APARTMENT->value,
        'have_garden' => '1',
        'message' => 'Je souhaite adopter cet animal.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('send');

    expect(Adopter::count())->toBe(1);
    expect(Adoption::count())->toBe(1);

    $adoption = Adoption::first();

    expect($adoption->animal_id)->toBe($animal->id);
    expect($adoption->adopter_id)->toBe(Adopter::first()->id);
    expect($adoption->message)->toBe('Je souhaite adopter cet animal.');
    expect($adoption->status)->toBe(AdoptionStatus::SUBMITTED);
});
