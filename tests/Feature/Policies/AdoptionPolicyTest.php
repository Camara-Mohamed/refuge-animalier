<?php

use App\Enums\UserRole;
use App\Models\Adoption;
use App\Models\User;

it('allows admin and volunteer to view any and view', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $adoption = Adoption::factory()->create();

    expect($admin->can('viewAny', Adoption::class))->toBeTrue()
        ->and($volunteer->can('viewAny', Adoption::class))->toBeTrue()
        ->and($admin->can('view', $adoption))->toBeTrue()
        ->and($volunteer->can('view', $adoption))->toBeTrue();
});

it('restricts status change to admin', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $adoption = Adoption::factory()->create();

    expect($admin->can('changeStatus', $adoption))->toBeTrue()
        ->and($volunteer->can('changeStatus', $adoption))->toBeFalse();
});

it('restricts delete to admin', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $adoption = Adoption::factory()->create();

    expect($admin->can('delete', $adoption))->toBeTrue()
        ->and($volunteer->can('delete', $adoption))->toBeFalse();
});
