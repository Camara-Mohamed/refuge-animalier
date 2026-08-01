<?php

it('can access public animals page', function ($locale) {
    $response = $this->get(route('public.animals.index', ['locale' => $locale]));

    $response->assertStatus(200);
})->with(['fr', 'en', 'nl', 'de']);
