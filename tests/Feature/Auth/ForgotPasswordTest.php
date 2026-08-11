<?php

it('renders the forgot password view', function () {
    $response = $this->get(route('password.request', ['locale' => 'fr']));

    $response->assertStatus(200);
    $response->assertViewIs('auth.forgot-password');
});
