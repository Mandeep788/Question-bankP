<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserUpdateController extends Controller
{
    public function index(){
        $id =Auth::user()->id;
        $users = DB::table('users')->where ('id',$id)->get();
        //dd($users);
        //$user = App\User::where('id',$id)->first();
        return view('user_layout.view_profile',['users'=>$users]); 
    }
    public function edit(){
        $id =Auth::user()->id;
        $user = DB::table('users')->where ('id',$id)->get();
        
        return view('user_layout.user_edit',['user'=>$user]);
    }
    
    public function update(Request $request){
        $id =Auth::user()->id;
        $name = $request->input('name');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $address = $request->input('address');
                 DB::table('users')
              ->where('id','=',$id)
              ->update(['name' =>$name,
                        'email'=>$email,
                        'gender'=>$gender ,
                        'address'=>$address,
                       ]);   
                       return redirect('/view_profile');        
                    }
                }
