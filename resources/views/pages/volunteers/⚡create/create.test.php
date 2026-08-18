<?php

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Livewire;

it('allows admin to create a volunteer profile', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    Livewire::actingAs($admin)->test('pages::volunteers.create')
        ->set('name', 'Nouveau Bénévole')
        ->set('email', 'nouveau@example.com')
        ->set('password', 'password123')
        ->set('role', UserRole::VOLUNTEER->value)
        ->call('save')
        ->assertRedirect();

    $volunteer = User::where('email', 'nouveau@example.com')->first();
    expect($volunteer)->not->toBeNull()
        ->and($volunteer->role)->toBe(UserRole::VOLUNTEER);
});
