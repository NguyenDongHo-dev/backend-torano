<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\Category;
use App\Models\Product;
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
        Route::get('/{id}', [UserController::class, 'detailsMe']);
    });


    Route::middleware(['admin_jwt'])->group(function () {
        Route::get('/allUser', [UserController::class, 'index']);
        Route::delete('/delete/{id}', [UserController::class, 'delete']);
        Route::get('/details/{id}', [UserController::class, 'details']);
    });
});


//category
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::get('/type/{id}', [CategoryController::class, 'type']);





    Route::post('/', [CategoryController::class, 'create']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

//size
Route::prefix('size')->group(function () {
    Route::get('/', [SizeController::class, 'index']);
    Route::get('/{id}', [SizeController::class, 'show']);



    Route::post('/', [SizeController::class, 'store']);
    Route::put('/{id}', [SizeController::class, 'update']);
    Route::delete('/{id}', [SizeController::class, 'destroy']);
});

//color
Route::prefix('color')->group(function () {
    Route::get('/', [ColorController::class, 'index']);
    Route::get('/{id}', [ColorController::class, 'show']);



    Route::post('/', [ColorController::class, 'store']);
    Route::put('/{id}', [ColorController::class, 'update']);
    Route::delete('/{id}', [ColorController::class, 'destroy']);
});

//product
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);


    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

//wishlist
Route::prefix('wishlist')->group(function () {
    Route::get('/{id}', [WishlistController::class, 'index']);



    Route::post('/', [WishlistController::class, 'store']);
    Route::delete('/{id}', [WishlistController::class, 'destroy']);
});
