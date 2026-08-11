<?php

use App\Enums\UserRole;
use App\Models\Specie;
use App\Models\User;

it('allows admin and volunteer to view and create species', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $specie = Specie::factory()->create();

    expect($admin->can('viewAny', Specie::class))->toBeTrue()
        ->and($volunteer->can('viewAny', Specie::class))->toBeTrue()
        ->and($admin->can('view', $specie))->toBeTrue()
        ->and($volunteer->can('view', $specie))->toBeTrue()
        ->and($admin->can('create', Specie::class))->toBeTrue()
        ->and($volunteer->can('create', Specie::class))->toBeTrue();
});

it('restricts update and delete to admin', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $specie = Specie::factory()->create();

    expect($admin->can('update', $specie))->toBeTrue()
        ->and($volunteer->can('update', $specie))->toBeFalse()
        ->and($admin->can('delete', $specie))->toBeTrue()
        ->and($volunteer->can('delete', $specie))->toBeFalse();
});
