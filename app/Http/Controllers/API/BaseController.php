<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($response,$status="Success",$code=200)
    {
        return response()->json(['data' => $response , 'status' => $status],$code);
    }
}
