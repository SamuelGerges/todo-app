<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Request\User\CreateProductValidation;
use App\Request\User\CreateUserValidation;
use App\Request\User\LoginUserValidation;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function register(CreateUserValidation $createUserValidation)
    {
        if(!empty($createUserValidation->getErrors())){
            return response()->json($createUserValidation->getErrors(),404);
        }

        $user = $this->userService->createUser($createUserValidation->getRequest()->all());
        $message['user'] = $user;
        $message['token'] = $user->createToken('myApp')->plainTextToken;
        return $this->sendResponse($message,200);
    }

    public function login(LoginUserValidation $loginUserValidation)
    {
        if(!empty($loginUserValidation->getErrors())){
            return response()->json($loginUserValidation->getErrors(),406);
        }

        $request = $loginUserValidation->getRequest();
        $auth = auth()->attempt(['email' => $request->email,'password' => $request->password]);
        if($auth){
            $user = Auth::user();
            $message['token'] = $user->createToken('myApp')->plainTextToken;
            $message['user'] = $user;
            return $this->sendResponse($message,$user->name.' Login Successfully ',200);
        }else{
            return $this->sendResponse('Un Authorised',' Login Failed ',401);

        }
    }
}
