<?php

use App\Enums\UserRole;
use App\Models\User;

it('casts role attribute to UserRole enum', function () {
    $user = User::factory()->create(['role' => UserRole::ADMIN->value]);

    expect($user->role)->toBeInstanceOf(UserRole::class)
        ->and($user->role)->toBe(UserRole::ADMIN);
});

it('isAdmin returns true for admin role', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    expect($admin->isAdmin())->toBeTrue()
        ->and($volunteer->isAdmin())->toBeFalse();
});

it('isVolunteer returns true for volunteer role', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    expect($volunteer->isVolunteer())->toBeTrue()
        ->and($admin->isVolunteer())->toBeFalse();
});

it('exposes fullName', function () {
    $user = User::factory()->create(['name' => 'Jean Dupont']);

    expect($user->fullName())->toBe('Jean Dupont');
});
