<?php

namespace App\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class BaseRequestFormApi
{
    protected $_request;

    private $status = true;
    private $errors = array();

    public function __construct(Request $request = null, $forceDie = true)
    {
        if(!is_null($request)){
            $this->_request = $request;
            $rules = $this->rules();
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                if($forceDie){
                    $this->status = false;
                    $this->errors = $validator->errors()->toArray();
                }else{
                    $this->status = false;
                    $this->errors = $validator->errors()->toArray();
                }
            }
        }
    }

    abstract public function rules(): array;


    public function getRequest()
    {
        return $this->_request;
    }
    public function isStatus() : bool
    {
        return $this->status;
    }

    public function getErrors() : array
    {
        return $this->errors;
    }

}
