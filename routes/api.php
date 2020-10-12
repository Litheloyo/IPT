<?php

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
use App\Http\Controllers\AuthController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // dd($request);
    return response()->json([
        "firstname"=>"Loyce",
        "lastname"=>"Ngoboka"
    ]);
});




Route::post('/login',[AuthController::class,'process_signin']);

Route::post('/register',[AuthController::class,'process_signup']);
Route::get('/users',[AuthController::class,'getAllUsers']);


