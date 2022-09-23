<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
        public function index(){
                $data = ['name'=>'sandeep', 'data' =>"Hello sandeep"];
                $user['to'] ='kumarsandeep25294@gmail.com';
                Mail::send('user.email', $data, function($messages) use ($user){
                        $messages->to($user['to']);
                        $messages->subject("Hello ajay");
                });
        }
}