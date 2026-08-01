<?php

it('can access public home page', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(200);
});
