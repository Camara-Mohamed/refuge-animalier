<?php

it('can access public contact page', function () {
    $response = $this->get(route('public.contact'));

    $response->assertStatus(200);
});
