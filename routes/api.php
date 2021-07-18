<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiExamController;
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
Route::get('items',[ApiExamController::class,'index']);

Route::get('category',[ApiExamController::class,'category']);


