<?php

namespace App\Request\User;


use \App\Request\BaseRequestFormApi;
class CreateUserValidation extends BaseRequestFormApi
{

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
