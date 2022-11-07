<?php
namespace App\Http\Controllers\Api\V1;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class McqController extends Controller
{
    // public function index(){
    //     $technologies = DB::table('technologies')->get();

    //     $experiences = DB::table('experiences')->get();
    //     //dd($technologies);
    //     return view('admin.mcqQuestions',['technologies'=>$technologies,'experiences'=>$experiences]);
    // }
    public function show(Request $request){
        try{
                $technology_id= $request->technology_id;
                $id = explode(',',$technology_id);
                $frameworks = DB::table('frameworks')
                    ->whereIn('frameworks.technology_id',$id)
                    ->select('frameworks.technology_id','frameworks.id','frameworks.framework_name')->get();
            } 
        catch(QueryException $ex){
            return response()->json(['message'=> $ex->getMessage()],404);
        }
        if(count($frameworks)>0){
                return response()->json(['technology_id'=>$frameworks],200);
        }else{
            return response()->json(['message'=>'Framework are not found'],404);
        }
    }
    
    public function getMcq(Request $request){
        $frameworkId= $request->frameworkId;
        // dd($frameworkId);
        $mcqQuestion =DB::table('mcq_questions')
            //->join('mcq_answer','mcq_question.id','=','mcq_answer.mcq_question_id')
            ->where('framework_id',$frameworkId)
            ->select('mcq_questions','id','experience_id')
            ->get();
        $array = [];
        foreach($mcqQuestion as $question)
        {
            $data['id'] = $question->id;
            $data['question'] = $question->mcq_questions;
            $data['experience'] = $question->experience_id;
            $data['answer'] = $this->getAnswer($data['id']);
            $array[] = $data;
        }
        // print'<pre>';
        // print_r($array);
        // exit;
        // dd($mcqQuestion);
        return response()->json([
            'mcqQuestions'=>$array,
            'status'=>200
        ]);
    }
    public function getAnswer($questionId)
    {
        $mcq_answer = DB::table('mcq_answers')
            ->where('mcq_question_id',$questionId)
            ->select('mcq_answers','id','status')
            ->get();
        return $mcq_answer;
        //    print'<pre>';
        //    print_r($mcq_answer);
        //    exit;
        // dd($mcq_answer);
        // ->get();
    }

    public function addMcq(Request $request){
        $questionData=[
            'framework_id' => $request->frameworkId,
            'experience_id'=> $request->experience,
            'mcq_questions' => $request->mcq_question
        ];
        DB::table('mcq_questions')->insert($questionData);
        $id = DB::getPdo()->lastInsertId();
        $answers=$request->mcq_answer;
        $correctAnswer=$request->correctAnswer;
        foreach ($answers as $answer) {
            if($correctAnswer == $answer){
                $answerData[] = array(
                    'mcq_question_id'=>$id,
                    'mcq_answers' =>$answer,
                    'status' => 1
                );
            }else{
                $answerData[] = array(
                    'mcq_question_id'=>$id,
                    'mcq_answers' =>$answer,
                    'status' => 0
                );
            }
        }

        DB::table('mcq_answers')->insert($answerData);
        return back();
    }

    public function removeAnswer(Request $request)
    {
        if($request->id){
            DB::table('mcq_answers')->where('mcq_question_id', $request->id)->delete();
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function getMcqData(Request $request)
    {
        $mcqQuestions = DB::table('mcq_questions')
            ->where('id',$request->id)->first();

        $mcqAnswers = DB::table('mcq_answers')
            ->where('mcq_question_id',$request->id)->get();

        return response()->json([
            'mcqQuestions'=>$mcqQuestions,
            'mcqAnswers'=>$mcqAnswers,
            'status'=>200
        ]);
    }

    public function editMcq(Request $request){
        $questionData=[
            'framework_id' => $request->frameworkId,
            'experience_id'=> $request->experience,
            'mcq_questions' => $request->mcq_question
        ];
        DB::table('mcq_questions')->where('id', $request->id)->update($questionData);
        $id = $request->id;
        $answers=$request->mcq_answer;
        $correctAnswer=$request->correctAnswer;
        $answerData=[];
        foreach ($answers as $answer) {
            $mcqAnswers = DB::table('mcq_answers')->where('mcq_question_id', $request->id)->where('mcq_answers', $answer)->first();
            if(!$mcqAnswers) {
                if ($correctAnswer == $answer) {
                    $answerData[] = array(
                        'mcq_question_id' => $id,
                        'mcq_answers' => $answer,
                        'status' => 1
                    );
                } else {
                    $answerData[] = array(
                        'mcq_question_id' => $id,
                        'mcq_answers' => $answer,
                        'status' => 0
                    );
                }
            }
        }
        DB::table('mcq_answers')->insert($answerData);
        return back();
    }
}
