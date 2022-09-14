<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use app\Models\Datamodel;


class quiz_questionController extends Controller
{
    //
    public function quiz_question($block_id,$u_id)
    {
        $technologies = DB::table('technologies')->whereBetween('id', [1,10])->get();

        $quiz_question_data=DB::table('userquizzes')
        ->join('block_questions','block_questions.block_id','=','userquizzes.block_id')
        ->join('questions','block_questions.question_id','=','questions.id')
        ->where('userquizzes.block_id',$block_id)
        ->select('userquizzes.id as u','block_questions.block_id','block_questions.id','questions.question')->paginate(3);
         return view("user.quiz_question",['quiz_question'=>$quiz_question_data,'technologies'=>$technologies]);
    }
    public function insert_answer(Request $request)
    {

        $user_id=Auth::user()->id;
        $data=[
            'block_question_id' => $request->question_id,
            'answer' => $request->answer,
            'users_id'=>$user_id,
            'quiz_id'=>$request->quiz_id
        ];
        DB::table('user_assessments')->insert($data);
        $id = DB::getPdo()->lastInsertId();
        return response()->json(
            [
                'id'=>$id,
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );

    }
    public function update_answer(Request $request){
        $last_id=$request->last_id;
        $data=[
                        'answer' => $request->answer,
        ];

        $query=DB::table('user_assessments')->where('id',$last_id)->update($data);
        if($query){
            return response()->json(['status'=>200]);
        }
    }

    public function upatestatus(Request $request)
    {
        $user_id=Auth::user()->id;
       $date= date('Y:m:d H:i:s');
        // $date->toDateTimeString();
        $block_id=$request->block_id;
        $update_status=
        [
            'status'=>'Submitted',
            'submitted_at'=>$date,
        ];
        $query=DB::table('userquizzes')->where([['users_id',$user_id],['block_id',$block_id]])->update($update_status);
        if($query)
        {
            return response()->json(['status'=>200,
                'message'=>"you have successfully submit your quiz"
        ]);
        }

    }

}
