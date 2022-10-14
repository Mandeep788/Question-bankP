<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
date_default_timezone_set("Asia/Calcutta");

class McqQuizBlockController extends Controller
{
    public function index()
    {
        $technologies = DB::table('technologies')->get();
        //dd($technologies);
      return view('admin.McqQuizBlock',['technologies'=>$technologies]);
    }
    public function fetchFramework(Request $request){
        $technologyId=$request->technologyId;
        //dd($technologyId);
        $id=explode(',', $technologyId);
        $frameworks= DB::table('frameworks')
        // ->join ('technologies','technologies.id','=','frameworks.technology_id')
        ->whereIn('frameworks.technology_id',$id)
        ->select('frameworks.id','frameworks.technology_id','frameworks.framework_name')
       ->get();
       //dd($frameworks);
       if(count($frameworks)>0){
        return response()->json([
            'frameworks'=> $frameworks,
            'status' => 200
        ]);
       }else{
        return response()->json([
            'status'=>404
        ]);
       }
    }
    public function getMcqQuestions(Request $request){
        $frameworkId =$request->frameworkId;
        $frame_id=explode(',', $frameworkId);
         // dd($frameworkId);   QuizCount
        $experienceId =$request->experienceId;
         //dd($experienceId);
         $QuizCount =$request->QuizCount;
         $limitt = $request->limitt;
         //for loader
         if($QuizCount == 0){
            $offset = 0;
         }else{
            $QUIZ = $QuizCount * $limitt;
            //dd($limitt);
         }
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
            ->offset($offset)->limit($limitt)
            ->get();
       //  dd($Mcq);
         if(count($Mcq)>0){
            return response()->json(['status'=>200,'mcq_questions'=>$Mcq]);
         }else{
            return response()->json(['status'=>404]);
         }
    }
}
