<?php
namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class McqController extends Controller
{
    public function index(){
         $technologies = DB::table('technologies')->get();

         $experiences = DB::table('experiences')->get();
         //dd($technologies);
         return view('admin.mcqQuestions',['technologies'=>$technologies,'experiences'=>$experiences]);
    }
    public function show(Request $request){
       $technology_id= $request->technology_id;
       //dd($technology_id);
        $frameworks = DB::table('frameworks')
        ->where('technology_id',$technology_id)->get();
        // dd($frameworks);
       return response()->json([
        'technology_id'=>$frameworks,
        'status'=>200
       ]);
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
      //dd($request->all());
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
}
