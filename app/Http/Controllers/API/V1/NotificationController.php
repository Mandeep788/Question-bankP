<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NotificationController extends Controller
{
    public function getNotification($u_id)
    {
        $statusInitiate = [
            'status' => 'I'
        ];
        $statusAlreadyReviewed = [
            'status' => 'AR'
        ];
        $query = DB::table('userquizzes')->where([['users_id', $u_id], ['status', 'P']])->get();
        if (count($query) > 0) {
            DB::table('userquizzes')->where([['users_id', $u_id], ['status', 'P']])->update($statusInitiate);
        }
        $query2 = DB::table('userquizzes')->where([['users_id', $u_id], ['status', 'C']])->get();
        if (count($query2) > 0) {
            DB::table('userquizzes')->where([['users_id', $u_id], ['status', 'C']])->update($statusAlreadyReviewed);
        }

        $notificaton = DB::table('userquizzes')
            ->join('blocks', 'blocks.id', '=', 'userquizzes.block_id')
            ->where([
                ['users_id', $u_id], ['status', '=', 'P']
            ])
            ->orWhere([['users_id', $u_id], ['status', 'C']])
            ->orWhere([['users_id', $u_id], ['status', 'I']])
            ->select('userquizzes.id as id', 'blocks.block_name as blockName', 'userquizzes.status', 'userquizzes.block_aggregate as blockAggregate', 'userquizzes.feedback')->get();
            if(Count($notificaton)>0)
             {
            return response()->json([
                'data' => $notificaton,
            ],200);
            }else
            {
                return response()->json([
                    'message' => "This user_id Does't have any notification",
                ],404);
            }

            
    }
    public function getCount(Request $request)
    {
        $u_id = $request->u_id;
        $get_count = DB::table('userquizzes')->where([['users_id', $u_id], ['status', 'P']])
            ->orWhere([['users_id', $u_id], ['status', 'C']])->get();
        $count = count($get_count);
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

        ->select('userquizzes.id','blocks.block_name','userquizzes.status','users.name')
        ->orderBy('userquizzes.id','desc')
        ->get();

       return view('user.NotificationPanel',['notificationPanel' => $notificationPanel,'technologies'=>$technologies]);


    }
}
