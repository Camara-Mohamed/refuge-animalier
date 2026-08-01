<?php

it('sets default locale', function () {
    app()->setLocale('fr');

    expect(app()->getLocale())->toBe('fr');
});
