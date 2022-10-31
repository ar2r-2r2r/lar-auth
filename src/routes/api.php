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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/auth/is', [UserController::class, 'isAuth']);
Route::post('/auth/name', [UserController::class, 'getName'])->middleware('auth:sanctum');
Route::post('/auth/id', [UserController::class, 'getId'])->middleware('auth:sanctum');

Route::post('/link/create', [LinkController::class, 'createLink'])->middleware('auth:sanctum');
Route::post('/link/update',[LinkController::class, 'updateLink'])->middleware('auth:sanctum');
Route::post('/link/delete',[LinkController::class, 'deleteLink'])->middleware('auth:sanctum');
Route::post('/link/getUserLinks',[LinkController::class, 'getUserLinks'])->middleware('auth:sanctum');
Route::post('/link/getOriginalLink',[LinkController::class, 'getOriginalLink'])->middleware('auth:sanctum');

