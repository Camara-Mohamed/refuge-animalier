<?php

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Livewire;

it('allows admin to view and delete a volunteer profile', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value, 'name' => 'Rex Volunteer']);

    Livewire::actingAs($admin)->test('pages::volunteers.show', ['volunteer' => $volunteer])
        ->assertSee('Rex Volunteer')
        ->call('delete')
        ->assertRedirect();

    expect(User::find($volunteer->id))->toBeNull();
});

it('redirects an admin viewing their own profile through this page to admin.profile', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    Livewire::actingAs($admin)->test('pages::volunteers.show', ['volunteer' => $admin])
        ->assertRedirect(route('admin.profile', ['locale' => app()->getLocale()]));
});
