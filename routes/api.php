<?php

use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('country',[CountryController::class,'index']);

Route::get('country/{id}',[CountryController::class,'find']);

Route::post('addcountry',[CountryController::class,'store']);

Route::put('updatecountry/{id}',[CountryController::class,'update']);

Route::delete('deletecountry/{id}',[CountryController::class,'destroy']);
