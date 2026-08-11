<?php

use App\Enums\UserRole;
use App\Models\User;

it('redirects admin to the dashboard after login', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $response = $this->post(route('login', ['locale' => 'fr']), [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.dashboard', ['locale' => 'fr']));
});

it('redirects volunteer to the dashboard after login', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    $response = $this->post(route('login', ['locale' => 'fr']), [
        'email' => $volunteer->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('admin.dashboard', ['locale' => 'fr']));
});
