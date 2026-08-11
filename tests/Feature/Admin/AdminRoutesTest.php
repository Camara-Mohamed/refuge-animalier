<?php

use App\Enums\UserRole;
use App\Models\Adoption;
use App\Models\User;

it('allows admin and volunteer to access the shared dashboard', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    $this->actingAs($admin)->get(route('admin.dashboard', ['locale' => 'fr']))->assertStatus(200);
    $this->actingAs($volunteer)->get(route('admin.dashboard', ['locale' => 'fr']))->assertStatus(200);
});

it('allows admin and volunteer to access the adoptions', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    $this->actingAs($admin)->get(route('admin.adoptions.index', ['locale' => 'fr']))->assertStatus(200);
    $this->actingAs($volunteer)->get(route('admin.adoptions.index', ['locale' => 'fr']))->assertStatus(200);
});

it('allows admin to view an adoption', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $adoption = Adoption::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.adoptions.show',
        ['locale' => 'fr', 'adoption' => $adoption]));

    $response->assertStatus(200);
});

it('allows admin and volunteer to access the animals', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    $this->actingAs($admin)->get(route('admin.animals.index', ['locale' => 'fr']))->assertStatus(200);
    $this->actingAs($volunteer)->get(route('admin.animals.index', ['locale' => 'fr']))->assertStatus(200);
});

it('allows admin and volunteer to access the notes', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    $this->actingAs($admin)->get(route('admin.notes.index', ['locale' => 'fr']))->assertStatus(200);
    $this->actingAs($volunteer)->get(route('admin.notes.index', ['locale' => 'fr']))->assertStatus(200);
});

it('allows admin to access the messages', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $response = $this->actingAs($admin)->get(route('admin.messages.index', ['locale' => 'fr']));

    $response->assertStatus(200);
});

it('allows admin to access the volunteers', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $response = $this->actingAs($admin)->get(route('admin.volunteers.index', ['locale' => 'fr']));

    $response->assertStatus(200);
});

it('allows admin to access the reports page', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $response = $this->actingAs($admin)->get(route('admin.reports.index', ['locale' => 'fr']));

    $response->assertStatus(200);
});

it('blocks volunteer from admin pages', function () {
    $volunteer = User::factory()->create(['role' => UserRole::VOLUNTEER->value]);

    $this->actingAs($volunteer)->get(route('admin.messages.index', ['locale' => 'fr']))->assertForbidden();
    $this->actingAs($volunteer)->get(route('admin.volunteers.index', ['locale' => 'fr']))->assertForbidden();
    $this->actingAs($volunteer)->get(route('admin.reports.index', ['locale' => 'fr']))->assertForbidden();
});

it('redirects guests to the login page from admin routes', function () {
    app()->setLocale('fr');

    $response = $this->get(route('admin.dashboard', ['locale' => 'fr']));

    $response->assertRedirect(route('login', ['locale' => 'fr']));
});
