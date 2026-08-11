<?php

use App\Enums\UserRole;
use App\Models\Race;
use App\Models\User;

it('allows admin and volunteer to view and create races', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $race = Race::factory()->create();

    expect($admin->can('viewAny', Race::class))->toBeTrue()
        ->and($volunteer->can('viewAny', Race::class))->toBeTrue()
        ->and($admin->can('view', $race))->toBeTrue()
        ->and($volunteer->can('view', $race))->toBeTrue()
        ->and($admin->can('create', Race::class))->toBeTrue()
        ->and($volunteer->can('create', Race::class))->toBeTrue();
});

it('restricts approve, update and delete to admin', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $race = Race::factory()->create();

    expect($admin->can('approve', $race))->toBeTrue()
        ->and($volunteer->can('approve', $race))->toBeFalse()
        ->and($admin->can('update', $race))->toBeTrue()
        ->and($volunteer->can('update', $race))->toBeFalse()
        ->and($admin->can('delete', $race))->toBeTrue()
        ->and($volunteer->can('delete', $race))->toBeFalse();
});
