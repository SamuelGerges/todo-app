<?php

namespace App\Services;

use App\Events\NewProductEvent;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Review;
use Illuminate\Support\Facades\Event;

class ProductService
{
    public function getProducts()
    {
         return Product::all();
    }

    public function createProduct($data) : Product
    {
       $product = Product::create($data);
       $product->details()->create($data);
       Event::dispatch(new NewProductEvent($product));
       return $product;
    }


    public function updateProduct($id,$data) : Product
    {
        $product = $this->getProductById($id);
        $product->title = $data['title'];
//        $product->description = $data['description'];
        $product->details->size = $data['size'];
        $product->details->color = $data['color'];
        $product->details->price = $data['price'];
        $product->save();
        return $product;
    }


    public function deleteProduct($id)
    {
        $product = $this->getProductById($id);
        if($product->details){
            $product->details()->delete();
        }
        if($product->reviews){
            $product->reviews()->delete();
        }
        if($product->imagable){
            $product->imagable()->delete();
        }
        $product->delete();
    }


    public function getProductById($id)
    {
        return Product::find($id)->first();
    }

}
