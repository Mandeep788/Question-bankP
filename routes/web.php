<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FrameworkController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TechnologyController;





Route::get('/register',[AuthController::class,'loadRegister']);

Route::post('/register',[AuthController::class,'userRegister'])->name('userRegister');

Route::get('/login',function(){

    return redirect('/');

});
Route::get('/',[AuthController::class,'loadlogin']);
Route::post('/login',[AuthController::class,'userlogin'])->name('userlogin');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');



Route::group(['middleware'=>['web','checkadmin']],function(){

    Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);

    Route::get('/admin/adminprofile', [AuthController::class,'index']);
    Route::put('/admin/adminprofile/', [AuthController::class,'update'])->name('profile.update');
    
    Route::get('/index',[AuthController::class, 'index']);

    Route::get('/admin/technologies',[TechnologyController::class,'show'])->name('show');
    Route::get('/admin/technologies/add',[TechnologyController::class,'index']);
    Route::post('/admin/technologies',[TechnologyController::class,'create'])->name('create');
    Route::get('/admin/technologies/edit',[TechnologyController::class,'edit']);
    Route::post('/admin/technologies/update',[TechnologyController::class,'update']);
    Route::delete('/admin/technologies/delete/{id}',[TechnologyController::class,'destroy']);

    Route::get('/admin/frameworks',[FrameworkController::class,'index']);
    Route::post('/admin/frameworks',[FrameworkController::class,'store']);
    Route::get('/admin/frameworks/edit/{id}',[FrameworkController::class,'edit']);
    Route::post('/admin/frameworks/edit/{id}',[FrameworkController::class,'update']);
    Route::delete('/admin/frameworks/delete/{id}',[FrameworkController::class,'destroy']);

    Route::get('/admin/experiences',[ExperienceController::class,'index']);
    Route::post('/admin/experiences',[ExperienceController::class,'store']);
    Route::get('/admin/experiences/edit/{id}',[ExperienceController::class,'edit']);
    Route::post('/admin/experiences/edit/{id}',[ExperienceController::class,'update']);
    Route::delete('/admin/experiences/delete/{id}',[ExperienceController::class,'destroy']);

    Route::get('/admin/questions',[QuestionController::class,'index']);
    Route::post('/admin/questions',[QuestionController::class,'store']);
    Route::get('/admin/questions/edit/{id}',[QuestionController::class,'edit']);
    Route::post('/admin/questions/edit/{id}',[QuestionController::class,'update']);
    Route::delete('/admin/questions/delete/{id}',[QuestionController::class,'destroy']);


    // Route::get('/admin/profile',function(){
    //     return view('admin.user');
    //     });
        Route::get('/admin/users',function(){
            return view('admin.user');
            });
});
Route::group(['middleware'=>['web','checkuser']],function(){

    Route::get('/dashboard',[AuthController::class,'loadDashboard']);
});
