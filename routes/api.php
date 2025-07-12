<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//user
Route::prefix('user')->group(function(){
    Route::get('/',[UserController::class,'index']);
    Route::post('/',[UserController::class,'store']);

});
