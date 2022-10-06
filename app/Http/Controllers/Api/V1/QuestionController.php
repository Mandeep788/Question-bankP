<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    //Fetch Question
    public function index(Request $request, $id, $limit, $count)
    {
        $tech_id = $request->technology_id;
        $frame_id = $request->framework_id;

        if ($count == 0) {
            $offset = 0;
        } else {
            $offset = $count * $limit;
        }
        $ques_ans = DB::table('answers as a')
            ->join('questions as q', 'q.id', '=', 'a.question_id')
            ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
            ->where([
                ['q.experience_id', $id],
                ['f.technology_id', $tech_id],
                ['q.framework_id', $frame_id]
            ])
            ->select('q.question', 'a.question_id', 'a.answer')
            ->offset($offset)->limit($limit)
            ->get();
        $ques = DB::table('questions as q')
            ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
            ->select(
                'q.id',
                'q.question'
            )
            ->where([
                ['q.experience_id', $id],
                ['f.technology_id', $tech_id],
                ['q.framework_id', $frame_id]
            ])
            ->leftJoin('answers as a', 'a.question_id', '=', 'q.id')
            ->whereNull('a.question_id')
            ->limit(2)
            ->get();
            if(count($ques_ans)>0 || count($ques)>0){
                return response()->json([
                    'Ques' => $ques,
                    'QuesAnswer' => $ques_ans,
                    'status' => 200
                ]);
            }else{
                return response()->json(['status'=>404]);
            }

    }
    // Add Question
    public function store(Request $request)
    {
        $tech_id = $request->ques_technology_id;
        $query = DB::table('frameworks')->where('technology_id', $tech_id)->get();
        if (count($query) > 0) {
            $question_data = [
                'framework_id' => $request->ques_framework_id,
                'experience_id' => $request->ques_experience_id,
                'question' => $request->question,
                "created_at" => carbon::now()
            ];
            DB::table('questions')->insert($question_data);
            return response()->json([
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 404
            ]);
        }
    }
    // Add Answer
    public function storeAnswer(Request $request)
    {
        $answer_data = [
            'question_id' => $request->store_question_id,
            'answer' => $request->answer,
            "created_at" => carbon::now()
        ];
        DB::table('answers')->insert($answer_data);
        return response()->json([
            'status' => 200
        ]);
    }
    //Fetch for editing
    public function edit($id)
    {
        $ques_ans = DB::table('answers as a')
            ->join('questions as q', 'q.id', '=', 'a.question_id')
            ->where('a.question_id', $id)
            ->select('q.question', 'a.question_id', 'a.answer')
            ->first();
        return response()->json($ques_ans);
    }
    //Update Question Answer
    public function update(Request $request, $id)
    {
        $Question_data = [
            'question' => $request->edit_question,
            "updated_at" => carbon::now()
        ];
        DB::table('questions')->where('id', '=', $id)->update($Question_data);
        $Answer_data = [
            'answer' => $request->edit_answer,
            "updated_at" => carbon::now()
        ];
        DB::table('answers')->where('question_id', '=', $id)->update($Answer_data);
        return response()->json([
            'status' => 200
        ]);
    }

    //Delete Question Answer
    public function destroy($id)
    {
        $query = DB::table('questions')->find($id);
        if ($query) {
            DB::table('questions')->delete($query->id);
            return response()->json([
                'status' => 200
            ]);
        }
    }
}
