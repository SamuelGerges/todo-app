<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_product_without_auth()
    {
        $response = $this->post('/api/product');

        $response->assertStatus(500);
    }

    public function test_create_product_without_data()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->post('/api/product');
        $response->assertStatus(401);
    }
}
