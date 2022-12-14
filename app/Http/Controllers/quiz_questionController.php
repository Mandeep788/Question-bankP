<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use app\Models\Datamodel;
Use \Carbon\Carbon;
date_default_timezone_set("Asia/Calcutta");



class quiz_questionController extends Controller
{
    public function quizQuestion($quiz_id,$u_id)
    {
        $startedTime=DB::table('userquizzes')->where('id',$quiz_id)->value('started_at');
        if($startedTime==''){
            DB::table('userquizzes')->where('id',$quiz_id)->update(['started_at'=>date('Y-m-d H:i:s')]);
        }


        $technologies = DB::table('technologies')->whereBetween('id', [1,10])->get();

        $query=DB::table('userquizzes')
        ->join('block_questions','block_questions.block_id','=','userquizzes.block_id')
        ->join('blocks','blocks.id','=','userquizzes.block_id')
        ->join('questions','block_questions.question_id','=','questions.id')
        ->where('userquizzes.id',$quiz_id)
        ->select('userquizzes.id as u','block_questions.block_id','block_questions.id','questions.question','blocks.timer','userquizzes.started_at')->get();

        $quizQuestionData = array();
        foreach($query as $key=> $userTech)
        {
            $array['u'] = $userTech->u;
            $array['block_id'] = $userTech->block_id;
            $array['timer'] = $userTech->timer;
            $array['started_at'] = $userTech->started_at;
            $array['id'] = $userTech->id;
            $array['question'] = $userTech->question;
            $array['answer'] = $this->getAnswer($userTech->u,$userTech->id);
            $array['answerid']=$this->getAnswerId($userTech->u,$userTech->id);

            $quizQuestionData[] = $array;
        }

        // print '<pre>';
        // print_r($quizQuestionData);
        // exit;
         return view("user.quiz_question",['quizQuestionData'=>$quizQuestionData,'technologies'=>$technologies]);
    }

    public function getAnswerId($quiz_id,$ques_id)
    {
        $query = DB::table('user_assessments as ua')
        ->select('ua.id')
        ->where([['ua.quiz_id',$quiz_id],['ua.block_question_id', $ques_id]])->value('id');
        return $query;

    }
    public function getAnswer($quiz_id,$ques_id)
    {
        $query = DB::table('user_assessments as ua')
        ->select('ua.answer')
        ->where([['ua.quiz_id',$quiz_id],['ua.block_question_id', $ques_id]])->value('answer');
        return $query;

    }
    public function insertAnswer(Request $request)
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
    public function skipAnswer(Request $request)
    {
        $user_id=Auth::user()->id;
        $skipAnswer=[
            'block_question_id' => $request->question_id,
            'answer' => 'Skipped Answer',
            'users_id'=>$user_id,
            'quiz_id'=>$request->quiz_id
        ];
        $skip = DB::table('user_assessments')->insert($skipAnswer);
        $id = DB::getPdo()->lastInsertId();
        if($skip)
        {
        return response()->json(
            [
                'id'=>$id,
                'success' => true,
                'message' => 'Data skip successfully'
            ]
        );
         }

    }
    public function updateAnswer(Request $request){
        $last_id=$request->last;
        $data=[
                'answer' => $request->answer,
        ];

            $query=DB::table('user_assessments')->where('id',$last_id)->update($data);
            if($query){
                return response()->json(['status'=>200]);
            }

    }
    public function updateStatus(Request $request)
    {
        $user_id=Auth::user()->id;
       $date= date('Y-m-d H:i:s');
        $block_id=$request->block_id;
        $update_status=
        [
            'status'=>'S',
            'submitted_at'=>$date,
        ];
        $updateId=DB::table('userquizzes')->where([['users_id',$user_id],['block_id',$block_id]])->orderBy('id','desc')->latest()->value('id');
        $query = DB::table('userquizzes')->where('id',$updateId)->update($update_status);
        if($query)
        {
            return response()->json(['status'=>200,
                'message'=>"you have successfully submit your quiz"
        ]);
        }

    }
    public function statusInitiate()
    {
            return response()->json(['status'=>200]);
    }

}
