<?php

use App\Http\Controllers\Api\V1\TechnologyController;
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

Route::prefix('v1')->group(function () {
    Route::controller(TechnologyController::class)->group(function () {
        Route::get('/technologies', 'show');
        Route::post('/technologies', 'create');
        Route::get('/technologies/{id}', 'edit');
        Route::post('/technologies/{id}', 'update');
        Route::delete('/technologies/{id}', 'destroy');
    });
});

