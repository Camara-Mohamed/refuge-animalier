<?php

use App\Enums\UserRole;
use App\Models\Coat;
use App\Models\Race;
use App\Models\Specie;
use App\Models\User;
use Livewire\Livewire;

it('allows admin and volunteer to add a specie, race and coat', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $specie = Specie::factory()->create();

    Livewire::actingAs($volunteer)->test('pages::data')
        ->set('newSpecie', 'Chat')
        ->call('addSpecie')
        ->set('newRaceSpecieId', $specie->id)
        ->set('newRace', 'Siamois')
        ->call('addRace')
        ->set('newCoat', 'Court')
        ->call('addCoat');

    expect(Specie::where('name', 'Chat')->exists())->toBeTrue()
        ->and(Race::where('name', 'Siamois')->exists())->toBeTrue()
        ->and(Coat::where('name', 'Court')->exists())->toBeTrue();
});

it('allows admin to delete but denies volunteer', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $specie = Specie::factory()->create();

    Livewire::actingAs($volunteer)->test('pages::data')
        ->call('deleteSpecie', $specie->id)
        ->assertForbidden();

    Livewire::actingAs($admin)->test('pages::data')
        ->call('deleteSpecie', $specie->id);

    expect(Specie::find($specie->id))->toBeNull();
});
