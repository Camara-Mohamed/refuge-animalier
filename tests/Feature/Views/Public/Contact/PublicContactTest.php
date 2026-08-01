<?php

it('can access public contact page', function ($locale) {
    $response = $this->get(route('public.contact', ['locale' => $locale]));

    $response->assertStatus(200);
})->with(['fr', 'en', 'nl', 'de']);
