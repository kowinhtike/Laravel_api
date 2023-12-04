<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\AuthController;
use App\Http\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Laravel Sanctum
// https://www.youtube.com/watch?v=B8MAr9_O5ik&list=PLomHQtzMFqxxdrm4SgoCS0TAbcFqlUo10&index=38

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/posts',[PostController::class,"index"]);
    Route::post('/posts',[PostController::class,"store"]);
    Route::get('/posts/{id}',[PostController::class,"show"]);
    Route::put('/posts/{id}',[PostController::class,"update"]);
    Route::delete('/posts/{id}',[PostController::class,"delete"]);
    Route::post('/logout',[AuthController::class,'logout']);
});