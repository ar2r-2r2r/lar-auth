<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LinkController;
use App\Http\Controllers\API\UserController;
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

Route::post('/auth/createUser', [AuthController::class, 'createUser']);
Route::get('/auth/loginUser', [AuthController::class, 'loginUser']);
Route::get('/auth/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::get('/auth/is', [UserController::class, 'isAuth']);
Route::get('/auth/name', [UserController::class, 'getName'])
    ->middleware('auth:sanctum');
Route::get('/auth/id', [UserController::class, 'getId'])
    ->middleware('auth:sanctum');

Route::post('/link/create', [LinkController::class, 'createLink'])
    ->middleware('auth:sanctum');
Route::put('/link/update', [LinkController::class, 'updateLink'])
    ->middleware('auth:sanctum');
Route::delete('/link/delete', [LinkController::class, 'deleteLink'])
    ->middleware('auth:sanctum');
Route::get('/link/getUserLinks', [LinkController::class, 'getUserLinks'])
    ->middleware('auth:sanctum');
Route::get('/link/getOriginalLink', [LinkController::class, 'getOriginalLink'])
    ->middleware('auth:sanctum');

