<?php

namespace App\Request\User;

use \App\Request\BaseRequestFormApi;
class LoginUserValidation extends BaseRequestFormApi
{

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
