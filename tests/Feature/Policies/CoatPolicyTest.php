<?php

use App\Enums\UserRole;
use App\Models\Coat;
use App\Models\User;

it('allows admin and volunteer to view and create coats', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $coat = Coat::factory()->create();

    expect($admin->can('viewAny', Coat::class))->toBeTrue()
        ->and($volunteer->can('viewAny', Coat::class))->toBeTrue()
        ->and($admin->can('view', $coat))->toBeTrue()
        ->and($volunteer->can('view', $coat))->toBeTrue()
        ->and($admin->can('create', Coat::class))->toBeTrue()
        ->and($volunteer->can('create', Coat::class))->toBeTrue();
});

it('restricts update and delete to admin', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $coat = Coat::factory()->create();

    expect($admin->can('update', $coat))->toBeTrue()
        ->and($volunteer->can('update', $coat))->toBeFalse()
        ->and($admin->can('delete', $coat))->toBeTrue()
        ->and($volunteer->can('delete', $coat))->toBeFalse();
});
