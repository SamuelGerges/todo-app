<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser($data) : User
    {
//        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
}
