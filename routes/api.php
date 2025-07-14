<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//user
Route::prefix('user')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login'])->name('login');



    Route::middleware(['user_jwt'])->group(function () {
        Route::put('/update/{id}', [UserController::class, 'update']);
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/{id}', [UserController::class, 'details']);

        

    });


    Route::middleware(['admin_jwt'])->group(function () {
        Route::get('/allUser', [UserController::class, 'index']);
        Route::delete('/delete/{id}', [UserController::class, 'delete']);
        Route::get('/details/{id}', [UserController::class, 'details']);


    });
});
