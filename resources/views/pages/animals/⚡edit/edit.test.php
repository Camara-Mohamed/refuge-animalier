<?php

use App\Enums\UserRole;
use App\Models\Animal;
use App\Models\User;
use Livewire\Livewire;

it('allows volunteer to update their own animal', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $animal = Animal::factory()->create(['user_id' => $volunteer->id, 'name' => 'Old']);

    Livewire::actingAs($volunteer)->test('pages::animals.edit', ['animal' => $animal])
        ->set('name', 'New')
        ->call('save');

    expect($animal->fresh()->name)->toBe('New');
});

it('allows volunteer updating another animal', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $animal = Animal::factory()->create();

    Livewire::actingAs($volunteer)->test('pages::animals.edit', ['animal' => $animal])
        ->assertOk();
});
