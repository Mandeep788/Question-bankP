<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Datamodel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\navbarTechnologyController;
use Illuminate\Support\Facades\Cookie;

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
            // $id=DB::table('users')->select('id')->where('name',$request->name)->value('id');
            // DB::table('usertechnologies')->insert(['users_id'=>$id]);
            return response()->json(['status' => '200']);
        }else{
            return response()->json(['status' => '404']);
        }

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
        if($request->rememberme===null){
           Cookie::queue('login_email',$request->email,time()-60*60*24*100);
           Cookie::queue('login_pass',$request->password,time()-60*60*24*100);
         }
         else{
            Cookie::queue('login_email',$request->email,time()+60*60*24*100);
           Cookie::queue('login_pass',$request->password,time()+60*60*24*100);
         }
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

    public function fetchNotifications(){
        $notifications = Db::table('userquizzes as uq')->where('uq.status','S')->orWhere('uq.status','U')
                            ->join('users as u','u.id','=','uq.users_id')
                            ->join('blocks as b','b.id','=','uq.block_id')
                            ->select('uq.id','uq.status','u.name','b.block_name','uq.submitted_at')
                            ->get();

        $countNotifications = Db::table('userquizzes as uq')->where('uq.status','S')
                            ->join('users as u','u.id','=','uq.users_id')
                            ->join('blocks as b','b.id','=','uq.block_id')
                            ->select('uq.id','uq.status','u.name','b.block_name','uq.submitted_at')
                            ->get();
        $count_notifications=count($countNotifications);
        if(count($notifications)>0){
            return response()->json(['count_notifications'=>$count_notifications,'notifications'=>$notifications,'status'=>200]);
        }else{
            return response()->json(['count_notifications'=>0,'status'=>404]);
        }
    }

    public function notificationPanel(){
        $adminId = Auth::user()->id;
        $notificationData = DB::table('userquizzes as uq')
                            ->join('blocks as b','b.id','=','uq.block_id')
                            ->join('users as u','u.id','=','uq.users_id')
                            ->where('b.admin_id',$adminId)
                            ->select('uq.id','uq.block_aggregate','uq.feedback','uq.status','b.block_name','u.name')
                            ->get();
        return view('admin.notifications',['notificationData'=>$notificationData]);
    }

    public function loadDashboard()
    {
        return navbarTechnologyController::show();
    }
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function adminlogout(Request $request){
        Cookie::queue(Cookie::forget('login_email'));
        Cookie::queue(Cookie::forget('login_pass'));
        Auth::logout();
            $request->Session()->flush();
            return response()->json(['status'=>200]);
    }
}
