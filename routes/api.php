<?php

use App\Http\Controllers\api\CoursesApiController;
use App\Http\Controllers\api\AuthController;
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

Route::group(['prefix' => 'auth'], function () {



    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'userLogin']);



    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('user', [AuthController::class, 'userData']);
        Route::post('logout', [AuthController::class, 'userLogout']);
        Route::apiResource('apicourses', CoursesApiController::class);
    });
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
