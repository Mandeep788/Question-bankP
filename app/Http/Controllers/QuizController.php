<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index(){
        $technologies=DB::table('technologies')->get();
        return view('admin.quiz',['technologies'=>$technologies]);
    }
    public function getquestions(Request $request)
    {
        $tech_id=$request->tech_id;
        $frame_id=$request->frame_id;
        $id=$request->exp_id;
        $limit=$request->limit;
        $quiz_count=$request->quiz_count;
        if($quiz_count==0){
            $offset=0;
        }else{
            $offset=$quiz_count*$limit;
            // dd($limit);
        }
        if($id==0){
            $questions=DB::table('questions as q')
                ->join('frameworks as f','f.id','=','q.framework_id')
                ->where([
                ['f.technology_id',$tech_id],
                ['q.framework_id',$frame_id]
            ]);
        }else{
            $questions=DB::table('questions as q')
            ->join('frameworks as f','f.id','=','q.framework_id')
            ->where([
            ['f.technology_id',$tech_id],
            ['q.framework_id',$frame_id],
                ['q.experience_id',$id]
            ]);
        }
        $questions= $questions->select('q.id','q.question')->offset($offset)->limit($limit)->get();
        if(count($questions)>0){
        return response()->json(['status'=>200,'questions'=>$questions]);
        }
        else{
        return response()->json(['status'=>404]);
        }
    }

    public function savequestions(Request $request){
        $block_name=$request->block_name;
        $insert_data=$request->insert;
        $questions=explode(",",$insert_data);
        // dd($questions);
        $query=DB::table('blocks')->insert(['block_name'=>$block_name]);
        if($query){
           $block_id= DB::table('blocks')->select('id')->where('block_name',$block_name)->value('id');
            $data=array();
           foreach($questions as $question){
            if($question!=""){
            $data[] = array(
                'block_id'=>$block_id,
                'question_id'=>$question
            );
        }
           }
           $block_ques=DB::table('block_questions')->insert($data);
           if($block_ques){
            return response()->json([
                'status'=>200
            ]);
           }else{
            return response()->json([
                'status' => 404
            ]);
           }

        }else{
            return response()->json([
                'status' => 404
            ]);
        }
    }
}
