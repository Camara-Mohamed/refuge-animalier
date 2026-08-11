<?php

use App\Models\User;

it('logout the user and redirects to login', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout', ['locale' => 'fr']));

    $response->assertRedirect('/');
    $this->assertGuest();
});
