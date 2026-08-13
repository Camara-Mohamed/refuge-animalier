<?php

use App\Enums\UserRole;
use App\Models\Animal;
use App\Models\User;
use Livewire\Livewire;

it('shows every animal to a volunteer, not just their own', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    Animal::factory()->create(['user_id' => $volunteer->id, 'name' => 'Mine']);
    Animal::factory()->create(['name' => 'NotMine']);

    Livewire::actingAs($volunteer)->test('pages::animals.index')
        ->assertSee('Mine')
        ->assertSee('NotMine');
});

it('filters animals by search', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    Animal::factory()->create(['name' => 'Rex']);
    Animal::factory()->create(['name' => 'Milo']);

    Livewire::actingAs($admin)->test('pages::animals.index')
        ->set('search', 'Rex')
        ->assertSee('Rex')
        ->assertDontSee('Milo');
});
