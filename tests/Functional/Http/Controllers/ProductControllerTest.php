<?php

namespace App\Http\Controllers;

use Tests\TestCase;

/**
 * @author Bogusław Trojański
 */
class ProductControllerTest extends TestCase
{
    public function test_store()
    {
        $response = $this->post(
         '/product', [
             'name' => 'product example' . random_int(1, 10000),
             'price' => 200 + random_int(1, 10000),
             'currency' => 'PLN'
         ]);
        $response
            ->assertStatus(302);
    }

    public function test_index()
    {
        $response = $this->get(
            '/list');

        $response
            ->assertStatus(200);
    }


}
