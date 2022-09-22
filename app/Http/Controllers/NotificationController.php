<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

    public function getNotification($u_id)
    {
        $notificaton=DB::table('userquizzes')
        ->join('blocks','blocks.id','=','userquizzes.block_id')
        ->where([
            ['users_id',$u_id],['status','=','P']
        ])
        ->orWhere([['users_id',$u_id],['status','C']])
        ->orWhere([['users_id',$u_id],['status','I']])

        ->select('userquizzes.id','blocks.block_name','userquizzes.status','userquizzes.block_aggregate','userquizzes.feedback')->get();
        // dd($notificaton);
        // $count=count($notificaton);
        return response()->json([
           'notification'=> $notificaton,
        //    'count'=>$count
        ]);

        // $get_count=DB::table('userquizzes')->where('users_id',$u_id)->get();
        // $count=count($get_count);
        // return response()->json($count);
    }
    public function getCount(Request $request)
    {
        $u_id=$request->u_id;
        $get_count=DB::table('userquizzes')->where([['users_id',$u_id],['status','P']])
        ->orWhere([['users_id',$u_id],['status','C']])->get();
        $count=count($get_count);
        return response()->json($count);
    }
    public function NotificationPanel()
    {
        $user_id=Auth::user()->id;
        $technologies = DB::table('technologies') ->offset(0)->limit(7)->get();
        $notificationPanel=DB::table('userquizzes')
        ->join('blocks','blocks.id','=','userquizzes.block_id')
        ->join('users', 'blocks.admin_id','=' ,'users.id' )
        ->where([
            ['users_id',$user_id]
        ])
        

        ->Select('userquizzes.id','blocks.block_name','userquizzes.status','users.name')
        ->get();
      
       return view('user.NotificationPanel',['notificationPanel' => $notificationPanel,'technologies'=>$technologies]);
       
        
    }

}
