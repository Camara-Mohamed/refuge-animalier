<?php

use App\Enums\UserRole;
use App\Models\Message;
use App\Models\User;

it('allows only admin to manage contact messages', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $message = Message::create([
        'name' => 'Jean Dupont',
        'email' => 'jean.dupont@example.com',
        'subject' => 'Question sur un animal',
        'message' => 'Bonjour, je souhaiterais des informations.',
    ]);

    expect($admin->can('viewAny', Message::class))->toBeTrue()
        ->and($volunteer->can('viewAny', Message::class))->toBeFalse()
        ->and($admin->can('view', $message))->toBeTrue()
        ->and($volunteer->can('view', $message))->toBeFalse()
        ->and($admin->can('update', $message))->toBeTrue()
        ->and($volunteer->can('update', $message))->toBeFalse()
        ->and($admin->can('delete', $message))->toBeTrue()
        ->and($volunteer->can('delete', $message))->toBeFalse();
});
