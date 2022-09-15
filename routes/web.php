<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FrameworkController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\tech_user_Controller;
use App\Http\Controllers\UserUpdateController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\quiz_questionController;

Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'userRegister'])->name('userRegister');
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/', [AuthController::class, 'loadlogin']);
Route::post('/login', [AuthController::class, 'userlogin'])->name('userlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin/logout', [AuthController::class, 'adminlogout']);


Route::group(['middleware' => ['web', 'checkadmin']], function () {

    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);
    Route::get('/admin/dashboard-data', [AuthController::class, 'dashboardData']);
    Route::get('/admin/notifiications', [AuthController::class, 'fetchNotifications']);

    Route::get('/admin/technologies', [TechnologyController::class, 'show'])->name('show');
    Route::get('/admin/technologies/add', [TechnologyController::class, 'index']);
    Route::post('/admin/technologies', [TechnologyController::class, 'create'])->name('create');
    Route::get('/admin/technologies/edit', [TechnologyController::class, 'edit']);
    Route::post('/admin/technologies/update', [TechnologyController::class, 'update']);
    Route::delete('/admin/technologies/delete/{id}', [TechnologyController::class, 'destroy']);

    Route::get('/admin/frameworks/{id}', [FrameworkController::class, 'index']);
    Route::post('/admin/frameworks', [FrameworkController::class, 'store']);
    Route::get('/admin/frameworks/edit/{id}', [FrameworkController::class, 'edit']);
    Route::post('/admin/frameworks/edit/{id}', [FrameworkController::class, 'update']);
    Route::delete('/admin/frameworks/delete/{id}', [FrameworkController::class, 'destroy']);

    Route::get('/admin/experiences', [ExperienceController::class, 'index']);
    Route::post('/admin/experiences', [ExperienceController::class, 'store']);
    Route::get('/admin/experiences/edit/{id}', [ExperienceController::class, 'edit']);
    Route::post('/admin/experiences/edit/{id}', [ExperienceController::class, 'update']);
    Route::delete('/admin/experiences/delete/{id}', [ExperienceController::class, 'destroy']);

    Route::get('/admin/questions/{id}/{limit}/{count}', [QuestionController::class, 'index']);
    Route::post('/admin/questions', [QuestionController::class, 'store']);
    Route::post('/admin/answers', [QuestionController::class, 'storeAnswer']);
    Route::get('/admin/questions/edit/{id}', [QuestionController::class, 'edit']);
    Route::post('/admin/questions/edit/{id}', [QuestionController::class, 'update']);
    Route::delete('/admin/questions/delete/{id}', [QuestionController::class, 'destroy']);

    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users', [UserController::class, 'store']);
    // Route::get('/admin/users/list', [UserController::class, 'getUsers']);
    Route::get('/admin/userassessment/{id}', [UserController::class, 'assessmentIndex']);
    Route::get('/admin/assessmentdata', [UserController::class, 'getSubmittedBlock']);
    Route::post('/admin/userassessment',[UserController::class,'insertIndividualMarks']);
    Route::post('/admin/assessmentfeedback',[UserController::class,'feedbackBlock']);


    Route::get('/admin/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/admin/quiz/questions', [QuizController::class, 'getQuestions']);
    Route::post('/admin/quiz/questions', [QuizController::class, 'saveQuestions']);
    Route::get('/admin/totalquizblocks', [QuizController::class, 'fetchAllBlocks']);
    Route::get('/admin/blocks/{id}', [QuizController::class, 'fetchBlockQuestions']);
    Route::get('/admin/blockusers', [QuizController::class, 'fetchUsers']);
    Route::post('/admin/asssignblock', [QuizController::class, 'assignBlock']);
    Route::get('/admin/profile', [AuthController::class, 'index']);
    Route::get('/admin/profile/user', [AuthController::class, 'getProfileData']);
    Route::put('/admin/profile', [AuthController::class, 'update'])->name('profile.update');
});
Route::group(['middleware' => ['web', 'checkuser']], function () {

    Route::get('/dashboard', [AuthController::class, 'loadDashboard']);
    Route::get('/tech_data/{id}', [tech_user_Controller::class, 'index']);
    Route::get('/user_tech/{id}', [tech_user_Controller::class, 'show']);

    Route::get('/user_edit', [UserUpdateController::class, 'index']);
    Route::post('/user_edit', [UserUpdateController::class, 'update'])->name('user_edit');
    Route::get('/core_php', [tech_user_Controller::class, 'getQuestion']);

    Route::get('/notification/{u_id}', [NotificationController::class, 'getNotification']);
    Route::get('/get_count_value', [NotificationController::class, 'getCount']);
    Route::get('/quiz/{block_id}/{u_id}', [quiz_questionController::class, 'quizQuestion']);
    Route::post('/insertanswer', [quiz_questionController::class, 'insertAnswer']);
    Route::put('/updateanswer', [quiz_questionController::class, 'updateAnswer']);
    Route::put('/upatestatus',[quiz_questionController::class,'updateStatus']);
});
