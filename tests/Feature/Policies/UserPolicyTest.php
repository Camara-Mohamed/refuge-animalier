<?php

use App\Enums\UserRole;
use App\Models\User;

it('allows only admin to manage user accounts', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    expect($admin->can('viewAny', User::class))->toBeTrue()
        ->and($volunteer->can('viewAny', User::class))->toBeFalse()
        ->and($admin->can('view', $volunteer))->toBeTrue()
        ->and($volunteer->can('view', $admin))->toBeFalse()
        ->and($admin->can('create', User::class))->toBeTrue()
        ->and($volunteer->can('create', User::class))->toBeFalse()
        ->and($admin->can('update', $volunteer))->toBeTrue()
        ->and($volunteer->can('update', $admin))->toBeFalse()
        ->and($admin->can('deactivate', $volunteer))->toBeTrue()
        ->and($volunteer->can('deactivate', $admin))->toBeFalse()
        ->and($admin->can('resetPassword', $volunteer))->toBeTrue()
        ->and($volunteer->can('resetPassword', $admin))->toBeFalse()
        ->and($admin->can('delete', $volunteer))->toBeTrue()
        ->and($volunteer->can('delete', $admin))->toBeFalse();
});
