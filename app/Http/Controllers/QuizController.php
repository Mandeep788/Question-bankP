<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("Asia/Calcutta");
class QuizController extends Controller
{
    public function index()
    {
        $technologies = DB::table('technologies')->get();
        return view('admin.quiz', ['technologies' => $technologies]);
    }
    public function getquestions(Request $request)
    {
        $tech_id = $request->tech_id;
        $frame_id = $request->frame_id;
        $id = $request->exp_id;
        $limit = $request->limit;
        $quiz_count = $request->quiz_count;
        if ($quiz_count == 0) {
            $offset = 0;
        } else {
            $offset = $quiz_count * $limit;
            // dd($limit);
        }
        if ($id == 0) {
            $questions = DB::table('questions as q')
                ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                ->where([
                    ['f.technology_id', $tech_id],
                    ['q.framework_id', $frame_id]
                ]);
        } else {
            $questions = DB::table('questions as q')
                ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                ->where([
                    ['f.technology_id', $tech_id],
                    ['q.framework_id', $frame_id],
                    ['q.experience_id', $id]
                ]);
        }
        $questions = $questions->select('q.id', 'q.question')->offset($offset)->limit($limit)->get();
        if (count($questions) > 0) {
            return response()->json(['status' => 200, 'questions' => $questions]);
        } else {
            return response()->json(['status' => 404]);
        }
    }

    public function savequestions(Request $request)
    {
        $block_name = $request->block_name;
        $insert_data = $request->insert;
        $questions = explode(",", $insert_data);

        $query = DB::table('blocks')->insert(['block_name' => $block_name, 'created_at' => date('Y:m:d H:i:s')]);
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

    public function fetch_all_blocks(Request $request)
    {
        // $limit = $request->limit;
        // $quiz_count = $request->quiz_count;
        // if ($quiz_count == 0) {
        //     $offset = 0;
        // } else {
        //     $offset = $quiz_count * $limit;
        //     // dd($limit);
        // }
        $blocks = DB::table('blocks')->get();
        return view('admin.viewBlocks', ['blocks' => $blocks]);
    }

    public function fetch_block_questions(Request $request, $id)
    {
        $limit = $request->limit;
        $ques_count = $request->ques_count;
        if ($ques_count == 0) {
            $offset = 0;
        } else {
            $offset = $ques_count * $limit;
            // dd($limit);
        }
        $block_questions = DB::table('block_questions as bq')->where('bq.block_id', $id)
            ->join('questions as q', 'bq.question_id', '=', 'q.id')
            ->select('q.question')
            ->offset($offset)->limit($limit)
            ->get();
        if (count($block_questions) > 0) {
            return response()->json([
                'block' => $block_questions,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 404
            ]);
        }
    }

    public function fetch_users(Request $request)
    {
        $limit = $request->limit;
        $users_count = $request->users_count;
        if ($users_count == 0) {
            $offset = 0;
        } else {
            $offset = $users_count * $limit;
            // dd($limit);
        }
        $users = DB::table('users')->where('role', '=', 'user')
                    ->select('id', 'name', 'email')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
        if (count($users) > 0) {
            return response()->json(['users' => $users, 'status' => 200]);
        } else {
            return response()->json(['status' => 404]);
        }
    }

    public function assign_block(Request $request)
    {
        $block_id = $request->block_id;
        $user_id = $request->user_id;
        $block_users = explode(",", $user_id);
        $data = array();
        foreach ($block_users as $block_user) {
            if ($block_user != "") {
                $data[] = array(
                    'block_id' => $block_id,
                    'users_id' => $block_user
                );
            }
        }
        $block_assigned = DB::table('userquizzes')->insert($data);
        if ($block_assigned) {
            return response()->json([
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 404
            ]);
        }
    }
}
