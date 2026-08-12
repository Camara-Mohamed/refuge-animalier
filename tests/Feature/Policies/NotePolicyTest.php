<?php

use App\Enums\UserRole;
use App\Models\Note;
use App\Models\User;

it('allows admin and volunteer to view notes', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $note = Note::factory()->create();

    expect($admin->can('viewAny', Note::class))->toBeTrue()
        ->and($volunteer->can('viewAny', Note::class))->toBeTrue()
        ->and($admin->can('view', $note))->toBeTrue()
        ->and($volunteer->can('view', $note))->toBeTrue();
});

it('allows admin and volunteer to create note', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    expect($admin->can('create', Note::class))->toBeTrue()
        ->and($volunteer->can('create', Note::class))->toBeTrue();
});

it('allows admin and volunteer to update notes', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $ownNote = Note::factory()->create(['user_id' => $volunteer->id]);
    $otherNote = Note::factory()->create();

    expect($admin->can('update', $otherNote))->toBeTrue()
        ->and($volunteer->can('update', $ownNote))->toBeTrue()
        ->and($volunteer->can('update', $otherNote))->toBeFalse();
});

it('allows admin to delete', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $note = Note::factory()->create(['user_id' => $volunteer->id]);

    expect($admin->can('delete', $note))->toBeTrue()
        ->and($volunteer->can('delete', $note))->toBeFalse();
});
