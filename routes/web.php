<?php

use App\Http\Controllers\Api\V1\BotInterviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FrameworkController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\McqController;
use App\Http\Controllers\McqQuizBlockController;
use App\Http\Controllers\McqQuizQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\tech_user_Controller;
use App\Http\Controllers\UserUpdateController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\quiz_questionController;
use App\Http\Controllers\SoftDeleteController;

Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'userRegister'])->name('userRegister');
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/', [AuthController::class, 'loadlogin']);
Route::post('/login', [AuthController::class, 'userlogin'])->name('userlogin');
Route::get('/logout', [AuthController::class, 'adminlogout']);

Route::get('/guest',[GuestController::class, 'index']);
Route::post('/guest',[GuestController::class, 'register']);
Route::get('/guest/quiz/{quizId}/{userId}', [GuestController::class, 'quizQuestion']);
Route::post('/guest-insert-answer', [GuestController::class, 'insertAnswer']);
Route::put('/guest-update-answer', [GuestController::class, 'updateAnswer']);
Route::post('/guest-skip-answer', [GuestController::class, 'skipAnswer']);
Route::put('/update-status',[GuestController::class,'updateStatus']);
Route::get('/guest-thankyou',function(){
    return view('guest.guest_thankyou');
});

//Admin Routes
Route::group(['middleware' => ['web', 'checkadmin']], function () {

    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);
    Route::get('/admin/profile', [AuthController::class, 'index']);
    Route::get('/admin/profile/user', [AuthController::class, 'getProfileData']);
    Route::put('/admin/profile', [AuthController::class, 'update'])->name('profile.update');
    Route::get('/admin/dashboard-data', [AuthController::class, 'dashboardData']);
    Route::get('/admin/notifiications', [AuthController::class, 'fetchNotifications']);
    Route::get('/admin/indexNotification', [AuthController::class, 'indexNotification']);
    Route::get('/admin/notificationPanel', [AuthController::class, 'notificationPanel']);

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
    // Route::delete('/admin/experiences/delete/{id}', [ExperienceController::class, 'destroy']);

    Route::get('/admin/questions/{id}/{limit}/{count}', [QuestionController::class, 'index']);
    Route::post('/admin/questions', [QuestionController::class, 'store']);
    Route::post('/admin/answers', [QuestionController::class, 'storeAnswer']);
    Route::get('/admin/questions/edit/{id}', [QuestionController::class, 'edit']);
    Route::post('/admin/questions/edit/{id}', [QuestionController::class, 'update']);
    Route::delete('/admin/questions/delete/{id}', [QuestionController::class, 'destroy']);

    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users', [UserController::class, 'store']);
    Route::get('/admin/users/list', [UserController::class, 'getUsers']);
    Route::get('/admin/userassessment/{id}', [UserController::class, 'assessmentIndex']);
    Route::get('/admin/assessmentdata', [UserController::class, 'getSubmittedBlock']);
    Route::post('/admin/userassessment',[UserController::class,'insertIndividualMarks']);
    Route::post('/admin/assessmentfeedback',[UserController::class,'feedbackBlock']);
    Route::post('/admin/feedback',[UserController::class,'feedbackData']);
    Route::get('/admin/view-pdf/{id}',[UserController::class,'viewPDF']);
    Route::get('/admin/download-pdf/{id}',[UserController::class,'downloadPDF']);


    Route::get('/admin/mcq_questions',[McqController::class, 'index'])->name('admin/mcq_questions');
    Route::post('/admin/mcq_frameworks',[McqController::class, 'show']);
    Route::post('/admin/mcq_questions',[McqController::class, 'getMcq']);
    Route::post('/admin/mcq_questions/addMcq',[McqController::class,'addMcq']);
    Route::get('/admin/mcq_questions/getEditMcq',[McqController::class,'getMcqData']);
    Route::delete('/admin/mcq_questions/removeAnswer',[McqController::class,'removeAnswer']);
    Route::post('/admin/mcq_questions/editMcq',[McqController::class,'editMcq']);

    Route::get('/admin/McqQuizBlock',[McqQuizBlockController::class,'index'])->name('admin/McqQuizBlock');
    Route::get('/admin/QuizBlocks/Frameworks',[McqQuizBlockController::class,'fetchFramework']);
    Route::get('/admin/Mcq/questions',[McqQuizBlockController::class,'getMcqQuestions']);


    Route::get('/admin/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/admin/quiz/frameworks',[QuizController::class,'fetchFrameworks']);
    Route::get('/admin/quiz/questions', [QuizController::class, 'getQuestions']);
    Route::post('/admin/quiz/questions', [QuizController::class, 'saveQuestions']);
    Route::get('/admin/quiz/randomquestions', [QuizController::class, 'getRandomQuestions']);
    // Route::post('/admin/quiz/randomquestions', [QuizController::class, 'saveRandomQuestions']);
    Route::get('/admin/indexblock', [QuizController::class, 'indexBlocks']);
    Route::get('/admin/totalquizblocks', [QuizController::class, 'fetchAllBlocks']);
    Route::get('/admin/blocks/{id}', [QuizController::class, 'fetchBlockQuestions']);
    Route::get('/admin/blockusers', [QuizController::class, 'fetchUsers']);
    Route::post('/admin/asssignblock', [QuizController::class, 'assignBlock']);


    Route::get('/viewBlocks/destroy/{id}',[SoftDeleteController::class, 'destroy']);
    Route::get('/admin/restoreBlocks/{id}',[SoftDeleteController::class, 'restore']);
    Route::get('/viewBlocksRestore',function(){ return view('admin.viewBlocksRestore');});
    Route::get('/admin/restoreBlocks',[QuizController::class,'restoreBlocks'])->name ('restoreBlocks');

    Route::get('/mail/{id}',[MailController::class,'Mail']);
    Route::post('/mail',[MailController::class,'sendMail']);

});

//User Routes
Route::group(['middleware' => ['web', 'checkuser']], function () {

    Route::get('/dashboard', [AuthController::class, 'loadDashboard']);
    Route::get('/tech_data/{id}', [tech_user_Controller::class, 'index']);
    Route::get('/user_tech/{id}', [tech_user_Controller::class, 'show']);

    Route::get('/user_edit', [UserUpdateController::class, 'index']);
    Route::post('/user_edit', [UserUpdateController::class, 'update'])->name('user_edit');
    Route::get('/core_php', [tech_user_Controller::class, 'getQuestion']);

    Route::post('/update-password', [UserUpdateController::class, 'updatePassword'])->name("update-password");

    Route::put('/notification/{u_id}', [NotificationController::class, 'getNotification']);
    Route::get('/get_count_value', [NotificationController::class, 'getCount']);
    Route::get('/quiz/{quizId}/{userId}', [quiz_questionController::class, 'quizQuestion']);

    Route::post('/insertanswer', [quiz_questionController::class, 'insertAnswer']);
    Route::put('/updateanswer', [quiz_questionController::class, 'updateAnswer']);
    Route::put('/upatestatus',[quiz_questionController::class,'updateStatus']);
    Route::get('/quiz',[quiz_questionController::class,'statusInitiate']);
    Route::post('/skipAnswer', [quiz_questionController::class, 'skipAnswer']);

    Route::get('/mcq/{quizId}/{userId}', [quiz_questionController::class, 'mcqQuizQuestion']);

    Route::get('/notificationPanel', [NotificationController::class, 'NotificationPanel']);
    Route::get('/user/download-pdf/{id}',[UserController::class,'downloadPDF']);

    Route::get('/user/mcq',[UserController::class,'getIndex']);
    Route::post('/user/mcq-insert',[McqQuizQuestionController::class,'insertMcq']);
    Route::put('/user/mcq-statusupdate',[McqQuizQuestionController::class,'updateMcqStatus']);

    Route::get('/video',function(){
        return view('video');
    });

    Route::get('/chatbot-questions',[quiz_questionController::class,'getChatbotQuiz']);


});

//Mail Routes
Route::post('/admin/send-email-pdf', 'App\Http\Controllers\SendEmailController@sendMail');
Route::get('/admin/show-data','App\Http\Controllers\SendEmailController@showDataOnMailBox');

// Route::get('/chart',[BotInterviewController::class,"chart"]);

