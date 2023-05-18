<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\UserMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends BaseController
{
    public function send()
    {
        Mail::to(Auth::user()->email)->send(new UserMailable());
        return $this->sendResponse('Email Send Successfully');
    }
}
