<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use app\Models\Datamodel;
Use \Carbon\Carbon;
use Illuminate\Database\QueryException;
date_default_timezone_set("Asia/Calcutta");



class QuizQuestionController extends Controller
{
    //
    public function quizQuestion($quiz_id)
    {
        try{
            $query=DB::table('userquizzes')
            ->join('block_questions','block_questions.block_id','=','userquizzes.block_id')
            ->join('questions','block_questions.question_id','=','questions.id')
            ->where('userquizzes.id',$quiz_id)
            ->select('userquizzes.id as u','block_questions.block_id','block_questions.id','questions.question')->get();

            $quizQuestionData = array();
            foreach($query as $key=> $userTech)
            {
                $array['userQuizzesId'] = $userTech->u;
                $array['blockId'] = $userTech->block_id;
                $array['blockQuestionId'] = $userTech->id;
                $array['question'] = $userTech->question;
                $array['answer'] = $this->getAnswer($userTech->u,$userTech->id);
                $array['answerId']=$this->getAnswerId($userTech->u,$userTech->id);

                $quizQuestionData[] = $array;
            }
        }catch(QueryException $e){
            return response()->json(['message'=> $e->getMessage()],404);
        }
       if(empty($quizQuestionData)){
        return response()->json(['message'=>'Content not found for Quiz Id ='.$quiz_id],404);
       }
        return response()->json(['data'=>$quizQuestionData],200);
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
        $Q=DB::table('userquizzes as Uq')
        ->join('block_questions as Bq','Bq.block_id','=','Uq.block_id')
        ->where('Bq.id',$request->question_id)->get();
        if(Count($Q)<1)
        {
            return response()->json([
                'message'=>'not acceptable value',
            ],403);
        }
        $query = DB::table('user_assessments as ua')
        ->where([['ua.quiz_id',$request->quiz_id],['ua.block_question_id', $request->question_id]])
        ->select('ua.block_question_id','ua.quiz_id')->get();

        if(Count($query)>0)
        {
            return response()->json([
                'message'=>'Duplicate value exists'
            ],409);
        }
        else{

            DB::table('user_assessments')->insert($data);
            $id = DB::getPdo()->lastInsertId();
            $userAssessmentData = DB::table('user_assessments')->where('id',$id)->select('id as userAssessmentId','users_id as usersId','quiz_id as quizId','block_question_id as blockQuestionId','answer')->get();
            return response()->json(
                [
                    'data'=>$userAssessmentData
                ],200
            );
        }

    }
    public function skipAnswer(Request $request)
    {
        $user_id=Auth::user()->id;
        $skipAnswer=[
            'block_question_id' => $request->question_id,
            'answer' => '0',
            'users_id'=>$user_id,
            'quiz_id'=>$request->quiz_id
        ];
        $Q=DB::table('userquizzes as Uq')
        ->join('block_questions as Bq','Bq.block_id','=','Uq.block_id')
        ->where('Bq.id',$request->question_id)->get();
        if(Count($Q)<1)
        {
            return response()->json([
                'message'=>'not acceptable value',
            ],403);
        }
        $skip = DB::table('user_assessments')->insert($skipAnswer);
        $id = DB::getPdo()->lastInsertId();
        if($skip)
        {
        return response()->json(
            [
                'id'=>$id,
                'message' => 'Data skip successfully'
            ],200
        );
         }

    }
    public function updateAnswer(Request $request){
        $last_id=$request->last;
        // dd($last_id);
        $data=[
                'answer' => $request->answer,
        ];

            $query=DB::table('user_assessments')->where('id',$last_id)->update($data);
            if($query){
                return response()->json([
                'message'=>'update successfully',
                ],200);
            }
            else{
                return response()->json([
                    'last_id'=> $last_id,
                    'message'=>'update unsuccessfully',
                    ],404);

            }

    }
    public function updateStatus(Request $request)
    {


            $user_id=Auth::user()->id;
            $date= date('Y-m-d H:i:s');
            $block_id=$request->block_id;
            $update_status=
            [
                'status'=>'Submitted',
                'submitted_at'=>$date,
            ];
            $updateId=DB::table('userquizzes')->where([['users_id',$user_id],['block_id',$block_id]])->orderBy('id','desc')->latest()->value('id');
            if(!empty($updateId)){
                $query = DB::table('userquizzes')->where('id',$updateId)->update($update_status);
                if($query)
                {
                    return response()->json([
                    'block_id'=>$updateId,
                        'message'=>"you have successfully submit your quiz",
                ],200);
                }
            }
            else{
                    return response()->json([

                   'message'=>"you have unsuccessfully submit your quiz"
                    ],404);

            }


}

    public function statusInitiate()
    {
        $user_id=Auth::user()->id;

        $statusInitiate = [
            'status'=>'I'
        ];
        $query = DB::table('userquizzes')->where([['users_id',$user_id],['status','P']])->update($statusInitiate);

            return response()->json(['status'=>200,
            'message'=>"status update to initiate"
    ]);


    }

}

