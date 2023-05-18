<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::controller(RegisterController::class)->group(function (){
    Route::post('register','register')->name('userRegister');
    Route::post('login','login')->name('userLogin');
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('product',ProductController::class);
    Route::post('import-excel' , [\App\Http\Controllers\API\ProductController::class,'import']);

    Route::controller(EmailController::class)->group(function (){
        Route::get('send-email','send');
    });

    Route::controller(ThirdPartyController::class)->group(function (){
        Route::get('get-api','index');
    });
});


Route::get('export-excel' , [\App\Http\Controllers\API\ProductController::class,'export']);


//Route::get('export-excel' , [ExcelController::class,'export']);
//Route::post('import-excel' , [ExcelController::class,'import']);



