<?php

use App\Enums\UserRole;
use App\Models\Animal;
use App\Models\User;

it('allows admin and volunteer to view any and view', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $animal = Animal::factory()->create();

    expect($admin->can('viewAny', Animal::class))->toBeTrue()
        ->and($volunteer->can('viewAny', Animal::class))->toBeTrue()
        ->and($admin->can('view', $animal))->toBeTrue()
        ->and($volunteer->can('view', $animal))->toBeTrue();
});

it('allows admin and volunteer to create', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    expect($admin->can('create', Animal::class))->toBeTrue()
        ->and($volunteer->can('create', Animal::class))->toBeTrue();
});

it('allows admin to update any animal', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $animal = Animal::factory()->create();

    expect($admin->can('update', $animal))->toBeTrue();
});

it('allows volunteer to update only their own animal', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $ownAnimal = Animal::factory()->create(['user_id' => $volunteer->id]);
    $otherAnimal = Animal::factory()->create();

    expect($volunteer->can('update', $ownAnimal))->toBeTrue()
        ->and($volunteer->can('update', $otherAnimal))->toBeFalse();
});

it('allows admin to delete but denies volunteer', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $animal = Animal::factory()->create(['user_id' => $volunteer->id]);

    expect($admin->can('delete', $animal))->toBeTrue()
        ->and($volunteer->can('delete', $animal))->toBeFalse();
});
