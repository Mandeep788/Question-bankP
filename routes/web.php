<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserUpdateController;
use App\Http\Controllers\TechnologiesSecondController;

Route::get('/register',[AuthController::class,'loadRegister'])->name('loadRegister');

Route::post('/register',[AuthController::class,'userRegister'])->name('userRegister');

Route::get('/login',function(){

    return redirect('/');

});
Route::get('/',[AuthController::class,'loadlogin']);

Route::post('/login',[AuthController::class,'userlogin'])->name('userlogin');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');



Route::group(['middleware'=>['web','checkadmin']],function(){

    Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);
    Route::get('/admin/technologies',function(){
    return view('admin.technologies');
    });
    Route::get('/admin/profile',function(){
        return view('admin.user');
        });
});
Route::group(['middleware'=>['web','checkuser']],function(){
    Route::get('/dashboard',[AuthController::class,'loadDashboard']);
    Route::get('/user_edit',[UserUpdateController::class,'index']);
    Route::post('/user_edit',[UserUpdateController::class,'update'])->name('user_edit');
    //Route::get('/technologies_second',[TechnologiesSecondController::class,'index'])->name('technologies_second.index');
    Route::get('/technologies_second',[TechnologiesSecondController::class,'show']);
    Route::get('/questionbyexperience/{id}/{exp}',[TechnologiesSecondController::class,'GetQuestionsByExperience']);

});