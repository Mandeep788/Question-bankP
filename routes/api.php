<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\QuizQuestionController;
use App\Http\Controllers\API\UserUpdateController;
use App\Http\Controllers\API\NavBarController;
use App\Http\Controllers\API\NotificationController;


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
Route::middleware(['auth:sanctum'])->group(function(){
   
    Route::controller(UserController::class)->group(function(){

    Route::get('logout','logout');
    Route::put('update','update');
    Route::delete('delete','delete');
    

    });
    Route::controller(QuizQuestionController::class)->group(function(){

        Route::get('Question/{block_id}','quizQuestion');
        Route::post('insertAns','insertAnswer');
        Route::post('skipAns','skipAnswer');
        Route::put('updateAns','updateAnswer');
        Route::put('updateStatus','updateStatus');
        });


        Route::controller(UserUpdateController::class)->group(function(){

            Route::get('userGet','index');
            Route::post('userUpdate','update');
            });

        Route::controller(NavBarController::class)->group(function(){
            Route::post('navBar','show');
            });  
            
            
        Route::controller(NotificationController::class)->group(function(){
            Route::post('getNotification','getNotification');
            });     
});

Route::controller(UserController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
    Route::post('exptable','index');
});


});