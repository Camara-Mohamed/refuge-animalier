<?php

it('can access public about page', function ($locale) {
    $response = $this->get(route('public.about', ['locale' => $locale]));

    $response->assertStatus(200);
})->with(['fr', 'en', 'nl', 'de']);
