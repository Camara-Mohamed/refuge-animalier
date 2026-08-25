<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::actingAs(User::factory()->create())->test('pages::profile')
        ->assertOk();
});

it('updates the personal information', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)->test('pages::profile')
        ->set('name', 'Nouveau Nom')
        ->set('address', 'Rue des Fleurs')
        ->set('number', '12')
        ->set('city', 'Bruxelles')
        ->set('code_postal', '1000')
        ->call('saveInfo');

    expect($user->fresh())
        ->name->toBe('Nouveau Nom')
        ->address->toBe('Rue des Fleurs')
        ->number->toBe('12')
        ->city->toBe('Bruxelles')
        ->code_postal->toBe('1000');
});

it('updates the email', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)->test('pages::profile')
        ->set('email', 'nouveau@example.com')
        ->call('saveEmail');

    expect($user->fresh()->email)->toBe('nouveau@example.com');
});

it('updates the password', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)->test('pages::profile')
        ->set('password', 'nouveau-mot-de-passe')
        ->call('savePassword');

    expect(Hash::check('nouveau-mot-de-passe', $user->fresh()->password))->toBeTrue();
});

it('updates the availabilities', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)->test('pages::profile')
        ->set('availabilities', ['monday', 'tuesday'])
        ->call('saveAvailabilities');

    expect($user->fresh()->availabilities)->toBe(['monday', 'tuesday']);
});

it('uploads a new avatar', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    Livewire::actingAs($user)->test('pages::profile')
        ->set('avatarFile', UploadedFile::fake()->image('avatar.jpg'))
        ->call('saveAvatar');

    expect($user->fresh()->avatar)->not->toBeNull();
    Storage::disk('public')->assertExists($user->fresh()->avatar);
});
