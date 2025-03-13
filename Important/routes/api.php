<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminsOnly;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::get('/product',[ProductsController::class,'index']);
Route::get('/product/{product}',[ProductsController::class,'show']);





Route::group(['middleware'=>['auth:sanctum']],function(){
Route::post('/logout',[UserController::class,'logout']);
});



Route::middleware(['auth:sanctum', 'admin'])->group(function(){
Route::post('/product/store',[ProductsController::class,'store']);
//Route::patch('/product/update/{product}',[ProductsController::class,'update']);
Route::delete('/product/delete/{product}',[ProductsController::class,'destroy']);
});  

Route::put('/product/update/{product}',[ProductsController::class,'update']);


// Route::get('/search/{search}',[ProductsController::class,'index']);
// Route::post('/checkoutprocess',[ProductsController::class,'checkoutprocess']);
// Route::post('/checkoutprocess/success',[ProductsController::class,'success'])->name('checkoutprocess.success');
// Route::post('/checkoutprocess/cancel',[ProductsController::class,'cancel'])->name('checkoutprocess.cancel');
// Route::middleware(['auth:sanctum', 'role:admin'])->get('/product/{product}',[] ); 
