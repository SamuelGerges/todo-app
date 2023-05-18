<?php

namespace App\Request\Product;


use \App\Request\BaseRequestFormApi;
class CreateProductValidation extends BaseRequestFormApi
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:100|unique:products,title',
            'description' => 'nullable|string|min:3|max:1000',
            'size' => 'required|numeric',
            'color' => 'required|string|in:green,red|min:3|max:100',
            'price' => 'required|numeric',
//            'product_id' => 'required|numeric|exists_',



        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
