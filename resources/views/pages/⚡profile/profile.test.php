<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::actingAs(User::factory()->create())->test('pages::profile')
        ->assertOk();
});

it('updates the name and email', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)->test('pages::profile')
        ->set('name', 'Nouveau Nom')
        ->set('email', 'nouveau@example.com')
        ->call('save');

    expect($user->fresh())
        ->name->toBe('Nouveau Nom')
        ->email->toBe('nouveau@example.com');
});

it('uploads a new avatar', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    Livewire::actingAs($user)->test('pages::profile')
        ->set('avatarFile', UploadedFile::fake()->image('avatar.jpg'))
        ->call('save');

    expect($user->fresh()->avatar)->not->toBeNull();
    Storage::disk('public')->assertExists($user->fresh()->avatar);
});
