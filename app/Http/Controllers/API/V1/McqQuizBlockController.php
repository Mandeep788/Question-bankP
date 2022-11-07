<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class McqQuizBlockController extends Controller
{
    // public function index()
    // {
    //   $technologies = DB::table('technologies')->get();
    //   return view('admin.McqQuizBlock',['technologies'=>$technologies]);
    // }

    public function fetchFramework(Request $request)
    {
        try{
            $technologyId=$request->technologyId;
            $id=explode(',', $technologyId);
            $frameworks= DB::table('frameworks')
            ->whereIn('frameworks.technology_id',$id)
            ->select('frameworks.id','frameworks.technology_id','frameworks.framework_name')
            ->get();
        }
        catch(QueryException $ex){
            return response()->json(['message'=> $ex->getMessage()],404);
        }

        if(count($frameworks)>0){
            return response()->json(['frameworks'=> $frameworks], 200);
        }else{
            return response()->json(['message'=> 'No framework found'],404);
        }
        
    }

    public function getMcqQuestions(Request $request)
    {
        if(!isset($request->frameworkId)){
            return response()->json(['message'=>'No MCQ question found'],400);
        }
        if(!isset($request->experienceId)){
            return response()->json(['message'=>'No MCQ question found. Please type experience'],400);
        }
        if(!isset($request->QuizCount)){
            return response()->json(['message'=>'Please select MCQ question block.'],400);
        }
        if(!isset($request->limitt)){
            return response()->json(['message'=>' MCQ question are not loaded'],400);
        }
        try{
            $frameworkId =$request->frameworkId;
            $frame_id=explode(',', $frameworkId);
            $experienceId =$request->experienceId;
            $QuizCount =$request->QuizCount;
            $limitt = $request->limitt;
            //for loader
            // if($QuizCount == 0){
            //     $offset = 0;
            // }else{
            //     $QUIZ = $QuizCount * $limitt;
            //     //dd($limitt);
            // }
            //for expereience
            if($experienceId == 0){
                $Mcq = DB::table('mcq_questions')
                    ->join('frameworks','frameworks.id','=','mcq_questions.framework_id')
                    ->whereIn('mcq_questions.framework_id',$frame_id);
            }else{
                $Mcq = DB::table('mcq_questions')->where('experience_id',$experienceId)
                ->join('frameworks','frameworks.id','=','mcq_questions.framework_id')
                ->whereIn('mcq_questions.framework_id',$frame_id);
            }
                $Mcq = $Mcq->select('mcq_questions.id','mcq_questions.mcq_questions')
                //->offset($offset)->limit($limitt)
                ->get();
        }
        catch(QueryException $ex){   
            return response()->json(['message'=> $ex->getMessage()],404);
        } 

            if(count($Mcq)>0){
                return response()->json(['mcq_questions'=>$Mcq],200);
            }else{
                return response()->json(['message'=>'No Question Found'],404);
            }
         
    }


    public function saveMcqQuiz(Request $request)
    {
        if(!isset($request->block_name)){
            return response()->json(['message'=> 'Block name is required.'],400);
        }
        if(!isset($request->insert)){
            return response()->json(['message'=> 'question Id id required.'],400);
        }
        if(!isset($request->timer)){
            return response()->json(['message'=> 'Timer is required.'],400);
        }
        if(!isset($request->type)){
            return response()->json(['message'=> 'Question type is required.'],400);
        }
        try{
            $admin_id = $request->id;
            $block_name = $request->block_name;
            $insert_data = $request->insert;
            $timer = $request->timer;
            $data=[
                'block_name' => $block_name,
                'timer'=>$timer,
                'admin_id'=>$admin_id,
                'created_at' => date('Y:m:d H:i:s')
            ];
            if(isset($request->type)){
                $data['type']= $request->type;
            }

            $questions = explode(",", $insert_data);
            $query = DB::table('blocks')->insert($data);
            $id= DB::getPdo()->lastInsertId();
            if ($query) {
                    $block_id = DB::table('blocks')->select('id')->where('block_name', $block_name)->value('id');
                    $data = array();
                    foreach ($questions as $question) {
                        if ($question != "") {
                            $data[] = array(
                                'block_id' => $block_id,
                                'question_id' => $question,
                                
                            );
                        }
                    }
                    $block_ques = DB::table('block_questions')
                    ->insert($data);
                    $mcqSave= DB::table('block_questions')
                    ->get();
                    return response()->json(['savedData'=>$mcqSave],200);
            }
        }
            catch(QueryException $ex){  
            return response()->json(['message'=>$ex->getMessage()],404); 
            if ($block_ques) {
                return response()->json(['questionBlock' => $block_ques],200);
            } else {
                return response()->json(['message'=>'Not Saved'],404);
            }
        }
    }

}