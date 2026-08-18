<?php

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Livewire;

it('allows admin to update a volunteer profile', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    Livewire::actingAs($admin)->test('pages::volunteers.edit', ['volunteer' => $volunteer])
        ->set('name', 'Nom Modifié')
        ->call('save')
        ->assertRedirect();

    expect($volunteer->fresh()->name)->toBe('Nom Modifié');
});

it('redirects an admin editing their own profile through this page to admin.profile', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    Livewire::actingAs($admin)->test('pages::volunteers.edit', ['volunteer' => $admin])
        ->assertRedirect(route('admin.profile', ['locale' => app()->getLocale()]));
});
