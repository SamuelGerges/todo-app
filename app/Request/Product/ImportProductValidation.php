<?php

namespace App\Request\Product;


use \App\Request\BaseRequestFormApi;
class ImportProductValidation extends BaseRequestFormApi
{

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:csv,xlsx|max:8162',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
