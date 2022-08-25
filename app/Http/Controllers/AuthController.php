<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if(Auth::user() && Auth::user()->role=='admin')
        {
         return redirect('/admin/dashboard');
        }
        else if(Auth::user() && Auth::user()->role=='user')
        {
         return redirect('/dashboard');
        }
        return view('register');
    }
    public function userRegister(Request $request)

    {
        $request->validate([
            'name'=>'string|required|min:4',
            'email'=>'string|email|required|max:100|unique:users',
            // 'country'=>'string|country|required',
            'password'=>'string|required|confirmed|min:8'
        ]);
        $user =new User;
         $user->name=$request->name;
         $user->email=$request->email;
        //  $user->country=$request->country;
         $user->password=bcrypt($request->password);
         $user->save();

         return back()->with('success',"Your registration has been successfully ");

    }
    public function loadlogin()
    {
       if(Auth::user() && Auth::user()->role=='admin')
       {
        return redirect('/admin/dashboard');
       }
       else if(Auth::user() && Auth::user()->role=='user')
       {
        return redirect('/dashboard');
       }
       return view('login');
    }
    public function userlogin(Request $request)
    {
        $request->validate([

            'email'=>'string|required|email',
            'password'=>'string|required'

        ]);
        $userCredential=$request->only('email','password');
        if(Auth::attempt($userCredential))
        {
                if(Auth::user()->role=='admin')
                {
                    return redirect('/admin/dashboard');
                }
                else{
                    return redirect('/dashboard');
                }
        }
        else{
            return  back()->with('error','Credential is invalid');

        }
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = DB::table('users')->where('id','=',$user_id)->get();
        return view('admin.adminprofile',['data'=> $data]);
        
    }

        public function update(Request $request)
        {
          $id= $request->id;
          $data = [
        "name" => $request->name,
        "email" => $request->email,
        "gender" => $request->gender,
        // "country" => $request->country,
        "password" => $request->password
        ];
        
        DB::table('users')->where('id','=',$id)->update($data);
        return redirect()->back()->with('status','Student Updated Successfully');
        }
    
     public function loadDashboard(){
        return view('/dashboard');
     }
     public function adminDashboard(){
        return view('admin.dashboard');
     }
     public function logout(Request $request)
     {
        $request->Session()->flush();
        Auth::logout();
        return redirect('/');
     }
}
