<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiItemsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('exams',[ApiExamController::class,'index']);
// Route::get('exams/{id}',[ApiExamController::class,'show']);


// Route::post('exams/store',[ApiExamController::class,'store']);

// Route::post('exams/update/{id}',[ApiExamController::class,'update']);
// Route::post('skillhub/register',[ApiAuthController::class,'register']);




// Route::post('skillhub/register',[ApiAuthController::class,'register']);
Route::get('items',[ApiItemsController::class,'index'])->middleware('IsLogin');

Route::get('category',[ApiItemsController::class,'category']);


Route::get('register_form',[ApiItemsController::class,'register_form']);


Route::post('register',[ApiItemsController::class,'register']);

Route::get('logout/{id}',[ApiItemsController::class,'logout']);

Route::post('login',[ApiItemsController::class,'login']);


Route::get('user_product/{id}',[ApiItemsController::class,'get_products']);


// product details
Route::get('product_details/{id}',[ApiItemsController::class,'Product_details']);


// search api

Route::post('search_items',[ApiItemsController::class,'search_items']);
