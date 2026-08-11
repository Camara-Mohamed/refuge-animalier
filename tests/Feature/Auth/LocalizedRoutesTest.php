<?php

it('returns 404 for the login page with an invalid locale', function () {
    $response = $this->get('/ru/login');

    $response->assertStatus(404);
});
