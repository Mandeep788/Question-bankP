<?php

namespace App\Http\Controllers\API\VI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class QuizQuestionController extends Controller
{
    //
    public function quizQuestion($quiz_id,$u_id)
    {
        $startedTime=DB::table('userquizzes')->where('id',$quiz_id)->value('started_at');
        if($startedTime==''){
            DB::table('userquizzes')->where('id',$quiz_id)->update(['started_at'=>date('Y:m:d H:i:s')]);
        }

        $technologies = DB::table('technologies')->whereBetween('id', [1,10])->get();

        $query=DB::table('userquizzes')
        ->join('block_questions','block_questions.block_id','=','userquizzes.block_id')
        ->join('questions','block_questions.question_id','=','questions.id')
        ->join('blocks','blocks.id','=','userquizzes.block_id')
        ->where('userquizzes.id',$quiz_id)
        ->select('blocks.block_name','userquizzes.id as u','block_questions.block_id','block_questions.id','questions.question')->get();

        $quizQuestionData = array();
        foreach($query as $key=> $userTech)
        {
            $array['u'] = $userTech->u;
            $array['block_name'] = $userTech->block_name;
            $array['block_id'] = $userTech->block_id;
            $array['id'] = $userTech->id;
            $array['question'] = $userTech->question;
            $array['answer'] = $this->getAnswer($userTech->u,$userTech->id);
            $array['answerid']=$this->getAnswerId($userTech->u,$userTech->id);

            $quizQuestionData[] = $array;
        }
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($quizQuestionData);
        $perPage = 1;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        // print '<pre>';
        // print_r($quizQuestionData);
        // exit;
      
        $paginatedItems->setPath($currentPage);  
        //  return view("user.quiz_question",['quizQuestionData'=>$paginatedItems,'technologies'=>$technologies]);
        return response()->json([$quizQuestionData]);
    }
    public function getAnswerId($quiz_id,$ques_id)
    {
        $query = DB::table('user_assessments as ua')
        ->select('ua.id')
        ->where([['ua.quiz_id',$quiz_id],['ua.block_question_id', $ques_id]])->value('id');
        // ->where('u.role', 'user')
    //    $answer=$query[0];

        return $query;

    }
    public function getAnswer($quiz_id,$ques_id)
    {
        $query = DB::table('user_assessments as ua')
        ->select('ua.answer')
        ->where([['ua.quiz_id',$quiz_id],['ua.block_question_id', $ques_id]])->value('answer');
        // ->where('u.role', 'user')
    //    $answer=$query[0];

        return $query;

    }
  
}
