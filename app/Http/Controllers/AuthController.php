<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'user') {
            return redirect('/dashboard');
        }
        return view('register');
    }
    public function userRegister(Request $request)

    {
        $request->validate([
            'name' => 'string|required|min:4',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:8'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['success' => 'succesfully']);
    }
    public function loadlogin()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'user') {
            return redirect('/dashboard');
        }
        return view('login');
    }
    public function userlogin(Request $request)
    {
        $request->validate([

            'email' => 'string|required|email',
            'password' => 'string|required'

        ]);
        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {
            if (Auth::user()->role == 'admin') {
                return response()->json('admin');
            } else {
                return response()->json('user');
            }
        } else {
            return response()->json(['error' => 'invalid credentials']);
        }
    }

    public function index()
    {

        return view('admin.profile');
    }

    public function getProfileData()
    {
        $user_id = Auth::user()->id;
        $query=DB::table('usertechnology')->where('users_id','=',$user_id)->get();
        $query=count($query);
        if($query==0){
        $data = DB::table('users')
                    ->select('users.name', 'users.email', 'users.gender', 'users.address', 'users.image')
                    ->where('users.id', $user_id)
                    ->LeftJoin('usertechnology', 'usertechnology.users_id', '=', 'users.id')
                    ->whereNull('usertechnology.users_id')
                    ->get();
        }else{
            $data = DB::table('users')
                    ->join('usertechnology', 'usertechnology.users_id', '=', 'users.id')
                    ->where('users.id', $user_id)
                    ->select('users.name', 'users.email', 'users.gender', 'users.address', 'users.image', 'usertechnology.designation', 'usertechnology.experience', 'usertechnology.last_company')
                    ->get();

        }
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $data = [
            "name" => $request->profile_name,
            "email" => $request->profile_email,
            "gender" => $request->profile_gender,
            "address" =>$request->profile_address,
            // "image" =>$request->image,
        ];
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename= $file->getClientOriginalName();
            $uniq_no= mt_rand();
            $unique_image= $uniq_no.'image'.$filename;
            $move= $file->move(public_path().'/uploads', $unique_image);
            if($move){
                $record = DB::table('users')->where('id', $id)->first();
                $file= $record->image;
                $filename = public_path().$file;
                \File::delete($filename);
            }
            $data['image']= "/uploads/".$unique_image;
        }
    
        $data1 = [
            "users_id" =>$id,
            "experience" => $request->profile_experience,
            "designation" => $request->profile_designation,
            "last_company" => $request->profile_last_company,
        ];
        $data2 = [
            "experience" => $request->profile_experience,
            "designation" => $request->profile_designation,
            "last_company" => $request->profile_last_company,
        ];

        DB::table('users')->where('id','=',$id)->update($data);
        $query=DB::table('usertechnology')->where('users_id','=',$id)->get();
        $query=count($query);
        if($query==0){
        DB::table('usertechnology')->where('users_id','=',$id)->insert($data1);
        }else{
        DB::table('usertechnology')->where('users_id','=',$id)->update($data2);
        }


        return redirect()->back()->with('status','Profile Update Successfully');
        // $query = DB::table('users')->where('id', '=', $id)->update($data);
        // if ($query) {
        //     return response()->json([
        //         'status' => 200
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 404
        //     ]);
        // }
    }
    public function dashboardData(){
        $technology=DB::table('technologies')->get();
        $technology=count($technology);
        $user=DB::table('users')->get();
        $user=count($user);
        $questions=DB::table('questions')->get();
        $questions=count($questions);
        return response()->json([
            'technologies'=>$technology,
            'users'=>$user,
            'questions'=>$questions,
        ]);
    }

    public function loadDashboard()
    {
        return view('/dashboard');
    }
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->Session()->flush();
        return redirect('/');
    }
}