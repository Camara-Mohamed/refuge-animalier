<?php

it('can access public home page', function () {
    $response = $this->get(route('public.home'));

    $response->assertStatus(200);
});
