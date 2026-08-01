<?php

it('can access public home page', function ($locale) {
    $response = $this->get(route('home', ['locale' => $locale]));

    $response->assertStatus(200);
})->with(['fr', 'en', 'nl', 'de']);
