<?php

use App\Enums\UserRole;
use App\Models\Message;
use App\Models\User;
use Livewire\Livewire;

it('marks the message as read when an admin views it', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $message = Message::factory()->create();

    Livewire::actingAs($admin)->test('pages::messages.show', ['message' => $message])
        ->assertSee($message->message);

    expect($message->fresh()->isRead())->toBeTrue();
});

it('allows admin to delete a message', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $message = Message::factory()->create();

    Livewire::actingAs($admin)->test('pages::messages.show', ['message' => $message])
        ->call('delete')
        ->assertRedirect();

    expect(Message::find($message->id))->toBeNull();
});
