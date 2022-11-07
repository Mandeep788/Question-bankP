<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
date_default_timezone_set("Asia/Calcutta");



class McqQuizBlockController extends Controller
{
    public function index()
    {
      $technologies = DB::table('technologies')->get();
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



    public function saveMcqQuiz(Request $request)
    {
        $admin_id = Auth::user()->id;
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
        if ($query) {
            $block_id = DB::table('blocks')->select('id')->where('block_name', $block_name)->value('id');
            $data = array();
            foreach ($questions as $question) {
                if ($question != "") {
                    $data[] = array(
                        'block_id' => $block_id,
                        'question_id' => $question
                    );
                }
            }
            $block_ques = DB::table('block_questions')->insert($data);
            if ($block_ques) {
                return response()->json([
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'status' => 404
                ]);
            }
        } else {
            return response()->json([
                'status' => 404
            ]);
        }
    }
}
