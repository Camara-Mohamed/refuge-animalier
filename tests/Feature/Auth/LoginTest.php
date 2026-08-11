<?php

it('renders the login page for guests', function () {
    $response = $this->get(route('login', ['locale' => 'fr']));

    $response->assertStatus(200);
});
