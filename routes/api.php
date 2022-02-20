<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CuadroController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']], function(){

    Route::post('logout',[AuthController::class,'logout']);
    Route::post('cuadro/create',[CuadroController::class,'create']);
    Route::get('cuadro/getAll',[CuadroController::class,'getAll']);
    Route::get('cuadro/get/{id}',[CuadroController::class,'get']);
    Route::post('cuadro/edit/{cuadro}',[CuadroController::class,'edit']);
    Route::delete('cuadro/delete/{id}',[CuadroController::class,'delete']);
    Route::get('cuadro/selet',[CuadroController::class,'search']);
});
