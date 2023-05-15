<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\CategoriesController;
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


// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/videos/free', [VideosController::class, 'indexFree']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(VideosController::class)->group(function () {
        Route::get('/videos', 'index');
        Route::post('/videos', 'store');
        Route::get('/videos/{id}', 'show');
        Route::put('/videos/{video}', 'update');
        Route::delete('/videos/{id}', 'destroy');
    });

    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/categorias', 'index');
        Route::post('/categorias', 'store');
        Route::get('/categorias/{id}', 'show');
        Route::put('/categorias/{category}', 'update');
        Route::delete('/categorias/{id}', 'destroy');
    
        Route::get('/categorias/{id}/videos', 'videosByCategory');
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});


