<?php

it('sets default locale correctly', function () {
    app()->setLocale('en');

    expect(app()->getLocale())->toBe('en');
});

it('redirects to default locale for home page', function () {
    $response = $this->get('/');

    $response->assertRedirect('/' . config('app.locale'));
});
