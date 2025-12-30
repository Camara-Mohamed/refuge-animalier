<?php

use Illuminate\Support\Facades\Schema;

it('has users table', function () {
    expect(Schema::hasTable('users'))->toBeTrue();
});

it('has animals table', function () {
    expect(Schema::hasTable('animals'))->toBeTrue();
});

it('has adoptions table', function () {
    expect(Schema::hasTable('adoptions'))->toBeTrue();
});

it('has notes table', function () {
    expect(Schema::hasTable('notes'))->toBeTrue();
});

it('has vaccines table', function () {
    expect(Schema::hasTable('vaccines'))->toBeTrue();
});

it('has adopters table', function () {
    expect(Schema::hasTable('adopters'))->toBeTrue();
});

it('has animal_vaccine table', function () {
    expect(Schema::hasTable('animal_vaccine'))->toBeTrue();
});

it('has races table', function () {
    expect(Schema::hasTable('races'))->toBeTrue();
});

it('has species table', function () {
    expect(Schema::hasTable('species'))->toBeTrue();
});

it('has coats table', function () {
    expect(Schema::hasTable('coats'))->toBeTrue();
});

it('has animal_pictures table', function () {
    expect(Schema::hasTable('animal_pictures'))->toBeTrue();
});
