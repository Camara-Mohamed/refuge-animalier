<?php

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Livewire;

it('lists volunteers', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    User::factory()->create(['role' => UserRole::VOLUNTEER->value, 'name' => 'Rex Volunteer']);

    Livewire::actingAs($admin)->test('pages::volunteers.index')
        ->assertSee('Rex Volunteer');
});

it('filters volunteers by search', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    User::factory()->create(['name' => 'Alice Martin']);
    User::factory()->create(['name' => 'Bob Durand']);

    Livewire::actingAs($admin)->test('pages::volunteers.index')
        ->set('search', 'Alice')
        ->assertSee('Alice Martin')
        ->assertDontSee('Bob Durand');
});
