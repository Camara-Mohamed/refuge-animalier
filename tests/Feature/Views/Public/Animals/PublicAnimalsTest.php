<?php

it('can access public animals page', function () {
    $response = $this->get(route('public.animals.index'));

    $response->assertStatus(200);
});
