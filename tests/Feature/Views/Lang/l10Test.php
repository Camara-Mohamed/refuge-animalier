<?php

/* Vérifie que la route redirige vers /fr */
it('redirects to fr', function () {
    $response = $this->get('/');

    $response->assertRedirect('/fr');
});

/* Vérifie que les pages renvoie 200 pour les locales valides */
it('home route returns 200 for valid locales', function ($locale) {
    $response = $this->get("/{$locale}/");

    $response->assertStatus(200);
})->with(['fr', 'en', 'nl', 'de']);

it('animals route returns 200 for valid locales', function ($locale) {
    $response = $this->get("/{$locale}/animals");

    $response->assertStatus(200);
})->with(['fr', 'en', 'nl', 'de']);

it('contact route returns 200 for valid locales', function ($locale) {
    $response = $this->get("/{$locale}/contact");

    $response->assertStatus(200);
})->with(['fr', 'en', 'nl', 'de']);

it('returns 404 for invalid locale', function () {
    $response = $this->get('/xx/');
    $response->assertStatus(404);
});
