<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\App;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    protected  ProductService $productService;
    protected  $product;



    public function setUp() : void
    {
        parent::setUp();
        $this->productService = $this->app->make('App\Services\ProductService');
        $this->product = [
          'title' =>'Shirt',
          'description' =>'',
          'user_id' =>'1',
          'color' =>'green',
          'size' =>'30',
          'price' =>'200.00',
        ];

    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_product_example()
    {

        $product_created = $this->productService->createProduct($this->product);
       $this->assertDatabaseHas('products',[
            'title' => 'Shirt',
        ]);
       $this->assertDatabaseHas('product_details',[
           'size' =>'30',
        ]);

    }
}
