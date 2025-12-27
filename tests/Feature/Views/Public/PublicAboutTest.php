<?php

it('can access public about page', function () {
    $response = $this->get(route('public.about'));

    $response->assertStatus(200);
});
