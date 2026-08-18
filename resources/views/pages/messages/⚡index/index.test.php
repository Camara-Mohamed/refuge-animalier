<?php

use App\Enums\UserRole;
use App\Models\Message;
use App\Models\User;
use Livewire\Livewire;

it('lists messages and allows admin to delete one', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $message = Message::factory()->create(['subject' => 'Question sur Bella']);

    Livewire::actingAs($admin)->test('pages::messages.index')
        ->assertSee('Question sur Bella')
        ->call('delete', $message->id);

    expect(Message::find($message->id))->toBeNull();
});

it('denies a volunteer from accessing the messages list', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    Livewire::actingAs($volunteer)->test('pages::messages.index')
        ->assertForbidden();
});
