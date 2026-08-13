<?php

use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use App\Models\Animal;
use App\Models\AnimalPicture;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('allows admin to change the animal status', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $animal = Animal::factory()->create(['status' => AnimalStatus::ADOPTABLE]);

    Livewire::actingAs($admin)->test('pages::animals.show', ['animal' => $animal])
        ->call('changeStatus', AnimalStatus::IN_PROCESS->value);

    expect($animal->fresh()->status)->toBe(AnimalStatus::IN_PROCESS);
});

it('allows volunteer changing another animal\'s status', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $animal = Animal::factory()->create(['status' => AnimalStatus::ADOPTABLE]);

    Livewire::actingAs($volunteer)->test('pages::animals.show', ['animal' => $animal])
        ->call('changeStatus', AnimalStatus::IN_PROCESS->value);

    expect($animal->fresh()->status)->toBe(AnimalStatus::IN_PROCESS);
});

it('allows admin to delete an animal', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $animal = Animal::factory()->create();

    Livewire::actingAs($admin)->test('pages::animals.show', ['animal' => $animal])
        ->call('delete')
        ->assertRedirect();

    expect(Animal::find($animal->id))->toBeNull();
});

it('denies volunteer deleting an animal', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $animal = Animal::factory()->create(['user_id' => $volunteer->id]);

    Livewire::actingAs($volunteer)->test('pages::animals.show', ['animal' => $animal])
        ->call('delete')
        ->assertForbidden();
});

it('allows adding a picture to the gallery', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $animal = Animal::factory()->create();

    Livewire::actingAs($admin)->test('pages::animals.show', ['animal' => $animal])
        ->set('newPicture', UploadedFile::fake()->image('photo.jpg'))
        ->call('addPicture');

    expect($animal->pictures()->count())->toBe(1);
});

it('allows deleting a picture from the gallery', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $animal = Animal::factory()->create();
    $picture = AnimalPicture::factory()->create(['animal_id' => $animal->id, 'path' => 'animals/photo.jpg']);

    Livewire::actingAs($admin)->test('pages::animals.show', ['animal' => $animal])
        ->call('deletePicture', $picture->id);

    expect(AnimalPicture::find($picture->id))->toBeNull();
});

it('allows adding and deleting a note on the animal', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $animal = Animal::factory()->create();

    Livewire::actingAs($admin)->test('pages::animals.show', ['animal' => $animal])
        ->set('newNote', 'Impressions de la visite du samedi.')
        ->call('addNote');

    expect($animal->notes()->count())->toBe(1);

    $note = $animal->notes()->first();

    Livewire::actingAs($admin)->test('pages::animals.show', ['animal' => $animal])
        ->call('deleteNote', $note->id);

    expect(Note::find($note->id))->toBeNull();
});

it('denies volunteer deleting another user\'s note', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);
    $animal = Animal::factory()->create();
    $note = Note::factory()->create(['notable_type' => Animal::class, 'notable_id' => $animal->id, 'user_id' => $admin->id]);

    Livewire::actingAs($volunteer)->test('pages::animals.show', ['animal' => $animal])
        ->call('deleteNote', $note->id)
        ->assertForbidden();
});
