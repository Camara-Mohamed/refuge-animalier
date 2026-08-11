<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

it('renders the reset password view with a valid token', function () {
    $user = User::factory()->create();
    $token = Password::createToken($user);

    $response = $this->get(route('password.reset', ['locale' => 'fr', 'token' => $token]));

    $response->assertStatus(200);
    $response->assertViewIs('auth.reset-password');
});

it('resets the password with a valid token', function () {
    Notification::fake();

    $user = User::factory()->create();
    $token = Password::createToken($user);

    $response = $this->post(route('password.update', ['locale' => 'fr']), [
        'token' => $token,
        'email' => $user->email,
        'password' => 'change_this_password',
        'password_confirmation' => 'change_this_password',
    ]);

    $response->assertSessionHasNoErrors();

    expect($user->fresh()->password)->not->toBe($user->password);
});
