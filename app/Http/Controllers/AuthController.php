<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Carbon\Carbon;
// use Illuminate\Http\File;
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
        if($user->save()){
            $id=DB::table('users')->select('id')->where('name',$request->name)->value('id');
            DB::table('usertechnologies')->insert(['users_id'=>$id]);
        }
        return response()->json(['success' => 'succesfully']);
    }

    public function regis(Request $request){
        $request->validate([    
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'tc'=>'required',
        ]);     
        if(User::where('email',$request->email)->first()){
            return response([
                'message'=>'Email already exists',
                'status'=>'failed'
            ],200);
        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'tc'=>json_decode($request->tc),
        ]);
        $token = $user->createToken($request->email)->plainTextToken;
        return response([
            'token' => $token,
            'message' => 'Registration successfully',
            'status' => 'success',                  
        ],201);
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
            $last_login=Auth::user()->last_login;
            session()->put('last_login',$last_login);
            $id=Auth::user()->id;
            date_default_timezone_set("Asia/Calcutta");
            DB::table('users')->where('id','=',$id)->update(['last_login'=>date('Y:m:d H:i:s')]);
            if (Auth::user()->role == 'admin') {
                return response()->json('admin');
            } else {
                return response()->json('user');
            }
        } else {
            return response()->json(['error' => 'invalid credentials']);
        }
    }


    public function loginUsr(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = User::where('email',$request->email)  ->first();
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken($request->email)->plainTextToken;
        return response([
            'token' => $token,
            'message' => 'Login successfully',
            'status' => 'success',
        ],200);
        }
        return response([
            'message' => 'The provided credentials are incorrect',
            'status' => 'failed',
        ],401);

        
        }

    public function index()
    {
        return view('admin.profile');
    }

    public function getProfileData()
    {
        $user_id = Auth::user()->id;
        $query=DB::table('usertechnologies')->where('users_id','=',$user_id)->get();
        $query=count($query);
        if($query==0){
        $data = DB::table('users as u')
                    ->select('u.name', 'u.email', 'u.gender', 'u.address', 'u.image', 'u.designation', 'u.experience', 'u.last_company')
                    ->where('u.id', $user_id)
                    ->LeftJoin('usertechnologies as ut', 'ut.users_id', '=', 'u.id')
                    ->whereNull('ut.users_id')
                    ->get();
        }else{
            $data = DB::table('users as u')
                    ->join('usertechnologies as ut', 'ut.users_id', '=', 'u.id')
                    ->where('u.id', $user_id)
                    ->select('u.name', 'u.email', 'u.gender', 'u.address', 'u.image', 'u.designation', 'u.experience', 'u.last_company')
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
            "experience" => $request->profile_experience,
            "designation" => $request->profile_designation,
            "last_company" => $request->profile_last_company,
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

        // $data1 = [
        //     "users_id" =>$id,

        // ];
        // $data2 = [
        //     "experience" => $request->profile_experience,
        //     "designation" => $request->profile_designation,
        //     "last_company" => $request->profile_last_company,
        // ];

        DB::table('users')->where('id','=',$id)->update($data);
        // $query=DB::table('usertechnology')->where('users_id','=',$id)->get();
        // $query=count($query);
        // if($query==0){
        // DB::table('usertechnology')->where('users_id','=',$id)->insert($data1);
        // }else{
        // DB::table('usertechnology')->where('users_id','=',$id)->update($data2);
        // }


        return redirect()->back()->with('status','Profile Update Successfully');

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
        return navbarTechnologyController::show();
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
