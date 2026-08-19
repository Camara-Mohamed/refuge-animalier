<?php

use App\Enums\UserRole;
use App\Models\Adoption;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $adoption = Adoption::factory()->create();

    Livewire::actingAs($admin)->test('pages::adoptions.show', ['adoption' => $adoption])
        ->assertOk();
});
