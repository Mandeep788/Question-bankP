<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
        
        return view('user_edit',['user'=>$user]);
    }
    
    public function update(Request $request){
        $id =Auth::user()->id;
        $name = $request->input('name');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $address = $request->input('address');
        $mobile_no = $request->input('mobile_no');
        $last_company=$request->input('last_company');
        $current_company=$request->input('current_company');
        $experience=$request->input('experience');
        $image=$request->input('image');
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename= $file->getClientOriginalName();
            $uniq_no= mt_rand();
            $unique_image= $uniq_no.'image'.$filename;
            $move= $file->move(public_path().'/img', $unique_image);
            if($move){
                $record = DB::table('users')->where('id', $id)->first();
                $file= $record->image;
                $filename = public_path().$file;
                File::delete($filename);
            }
            $image= "/img/".$unique_image;
        }
             DB::table('users')
              ->where('id','=',$id)
              ->update(['name' =>$name,
                        'email'=>$email,
                        'gender'=>$gender ,
                        'address'=>$address,
                        'mobile_no'=>$mobile_no,
                        'last_company'=>$last_company,
                        'current_company'=>$current_company,
                        'experience'=>$experience,
                        'image'=>$image,
                       ]);   
                       return redirect('/user_edit');        
                    }
                }
