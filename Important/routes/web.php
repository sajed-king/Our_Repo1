<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/checkoutprocess',[ProductsController::class,'checkoutprocess']);
Route::get('/checkoutprocess/success',[ProductsController::class,'success_stripe'])->name('checkoutprocess.success');
Route::get('/checkoutprocess/cancel',[ProductsController::class,'cancel'])->name('checkoutprocess.cancel');
Route::get('/checkoutprocess/cancel',[ProductsController::class,'cancel'])->name('checkoutprocess.cancel');
    
