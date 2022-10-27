<?php

use App\Http\Controllers\Api\V1\QuestionController;
use App\Http\Controllers\Api\V1\TechnologyController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\QuizQuestionController;
use App\Http\Controllers\Api\V1\UserUpdateController;
use App\Http\Controllers\Api\V1\NavBarController;
use App\Http\Controllers\Api\V1\NotificationController;


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
        Route::put('/technologies/{id}', 'update');
        Route::delete('/technologies/{id}', 'destroy');
    });
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/questions/{frameworkId}/{experienceId}', 'index');
        Route::post('/questions', 'store');
        Route::get('/questions/{id}', 'edit');
        Route::put('/questions/{id}', 'update');
        Route::delete('/questions/{id}', 'destroy');
    });
    Route::controller(UserController::class)->group(function (){
    Route::post('/users', 'store');
    Route::get('/users/list', 'getUsers');
    Route::get('/admin/userassessment/{id}', [UserController::class, 'assessmentIndex']);
    Route::get('/admin/assessmentdata', [UserController::class, 'getSubmittedBlock']);
    Route::post('/admin/userassessment',[UserController::class,'insertIndividualMarks']);
    Route::post('/admin/assessmentfeedback',[UserController::class,'feedbackBlock']);
    Route::post('/admin/feedback',[UserController::class,'feedbackData']);
    Route::get('/admin/view-pdf/{id}',[UserController::class,'viewPDF']);
    Route::get('/admin/download-pdf/{id}',[UserController::class,'downloadPDF']);
    });
});

Route::prefix('v1')->group(function () {
Route::middleware(['auth:sanctum'])->group(function(){

    Route::controller(AuthController::class)->group(function(){

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

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
    // Route::post('exptable','index');
});


});
