<?php

use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use App\Models\Animal;
use App\Models\User;
use Livewire\Livewire;

it('creates an animal that is adoptable and visible on the public site', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    Livewire::actingAs($admin)->test('pages::animals.create')
        ->set('name', 'Milo')
        ->set('gender', 'male')
        ->call('save')
        ->assertRedirect();

    $animal = Animal::where('name', 'Milo')->first();
    expect($animal)->not->toBeNull()
        ->and($animal->status)->toBe(AnimalStatus::ADOPTABLE);

    $this->get(route('public.animals.index', ['locale' => 'fr']))->assertSee('Milo');
});
