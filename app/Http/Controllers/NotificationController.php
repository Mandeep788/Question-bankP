<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        ->Select('blocks.id','blocks.block_name','userquizzes.status','userquizzes.block_aggregate','userquizzes.feedback')->get();
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

}
