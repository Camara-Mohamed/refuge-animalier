<?php

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    Livewire::actingAs($admin)->test('pages::dashboard')
        ->assertOk();
});
