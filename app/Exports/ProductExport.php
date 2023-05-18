<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromArray
{
    /**
    * @return array
    */
    public function array() : array
    {
        $list = [];
        $products = Product::all();
        foreach ($products as $product) {
            $list[] = [
                'title' => $product->title ,
                'description' => $product->description,
                'user_id' => $product->user_id,
                'user name' => $product->user->name
            ];
        }
        return  $list;
    }
}
