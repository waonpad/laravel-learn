<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\Post\DestroyPostController;
use App\Http\Controllers\Post\IndexPostController;
use App\Http\Controllers\Post\ShowPostController;
use App\Http\Controllers\Post\StorePostController;
use App\Http\Controllers\Post\UpdatePostController;
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

Route::get('/', [ExampleController::class, 'index']);

Route::prefix('posts')->group(function (): void {
    Route::get('/', IndexPostController::class);
    Route::post('/', StorePostController::class)->middleware('auth:sanctum');
    Route::get('/{id}', ShowPostController::class);
    Route::patch('/{id}', UpdatePostController::class)->middleware('auth:sanctum');
    Route::delete('/{id}', DestroyPostController::class)->middleware('auth:sanctum');
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
