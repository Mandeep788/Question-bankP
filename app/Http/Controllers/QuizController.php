<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

date_default_timezone_set("Asia/Calcutta");
class QuizController extends Controller
{
    public function index()
    {
        $technologies = DB::table('technologies')->get();
        return view('admin.quiz', ['technologies' => $technologies]);
    }

    public function fetchFrameworks(Request $request)
    {
        $technology_id = $request->technology_id;
        $id = explode(',', $technology_id);
        $frameworks = DB::table('frameworks as f')
            ->join('technologies as t', 't.id', '=', 'f.technology_id')
            ->whereIn('f.technology_id', $id)
            ->select('f.id', 'f.framework_name', 'f.technology_id', 't.technology_name')
            ->get();

        // return view('admin.technologies.index');
        if (count($frameworks) > 0) {
            return response()->json([
                'frameworks' => $frameworks,
                'status' => 200
            ]);
        } else {
            $technology = DB::table('technologies')
                ->where('id', '=', $id)
                ->select('id', 'technology_name')
                ->get();

            return response()->json([
                'technology' => $technology,
                'status' => 404
            ]);
        }
    }

    public function getQuestions(Request $request)
    {
        $frameworks_id = $request->frameworks_id;
        $frame_id = explode(',', $frameworks_id);
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
                ->whereIn('q.framework_id', $frame_id);
        } else {
            $questions = DB::table('questions as q')->where('q.experience_id', $id)
                ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                ->whereIn('q.framework_id', $frame_id);
        }
        $countQuestions = $questions->select('q.id', 'q.question')->count();
        $questions = $questions->select('q.id', 'q.question')->offset($offset)->limit($limit)->get();
        if (count($questions) > 0) {
            return response()->json(['status' => 200, 'questions' => $questions, 'countQuestions' => $countQuestions]);
        } else {
            return response()->json(['status' => 404]);
        }
    }
    public function getRandomQuestions(Request $request)
    {
        $frameworksId = $request->frameworksId;
        $frameId = explode(',', $frameworksId);
        $numberOfQuestions = (int)trim($request->numberOfQuestions);

        $first = round($numberOfQuestions / 3);
        $second = round($numberOfQuestions / 3);
        $third = (int)($numberOfQuestions - ($first + $second));


        $questions1 = DB::table('questions as q')->where('q.experience_id', '=', '1')
            ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
            ->whereIn('q.framework_id', $frameId)
            ->select('q.id', 'q.question')
            ->inRandomOrder()
            ->limit($first)
            ->get();
        if (count($questions1) == $first) {
            $questions2 = DB::table('questions as q')->where('q.experience_id', '=', '2')
                ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                ->whereIn('q.framework_id', $frameId)
                ->select('q.id', 'q.question')
                ->inRandomOrder()
                ->limit($second)
                ->get();
            if (count($questions2) == $second) {
                $questions3 = DB::table('questions as q')->where('q.experience_id', '=', '3')
                    ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                    ->whereIn('q.framework_id', $frameId)
                    ->select('q.id', 'q.question')
                    ->inRandomOrder()
                    ->limit($third)
                    ->get();
                if (count($questions3) == $third) {
                    return response()->json(['status' => 200, 'questions1' => $questions1, 'questions2' => $questions2, 'questions3' => $questions3]);
                } else {
                    $first = round($numberOfQuestions / 2);
                    $second = (int)($numberOfQuestions - $first);

                    $questions1 = DB::table('questions as q')->where('q.experience_id', '=', '1')
                        ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                        ->whereIn('q.framework_id', $frameId)
                        ->select('q.id', 'q.question')
                        ->inRandomOrder()
                        ->limit($first)
                        ->get();
                    if (count($questions1) == $first) {
                        $questions2 = DB::table('questions as q')->where('q.experience_id', '=', '2')
                            ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                            ->whereIn('q.framework_id', $frameId)
                            ->select('q.id', 'q.question')
                            ->inRandomOrder()
                            ->limit($second)
                            ->get();
                        if (count($questions2) == $second) {
                            return response()->json(['status' => 200, 'questions1' => $questions1, 'questions2' => $questions2]);
                        } else {
                            $questions1 = DB::table('questions as q')->where('q.experience_id', '=', '1')
                                ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                                ->whereIn('q.framework_id', $frameId)
                                ->select('q.id', 'q.question')
                                ->inRandomOrder()
                                ->limit($numberOfQuestions)
                                ->get();
                            return response()->json(['status' => 200, 'questions1' => $questions1]);
                        }
                    } else {
                        if (count($questions1) > 0) {
                            return response()->json(['status' => 200, 'questions1' => $questions1]);
                        } else {
                            return response()->json(['status' => 404]);
                        }
                    }
                }
            } else {
                $questions1 = DB::table('questions as q')->where('q.experience_id', '=', '1')
                    ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                    ->whereIn('q.framework_id', $frameId)
                    ->select('q.id', 'q.question')
                    ->inRandomOrder()
                    ->limit($numberOfQuestions)
                    ->get();
                return response()->json(['status' => 200, 'questions1' => $questions1]);
            }
        } else {
            if (count($questions1) > 0) {
                return response()->json(['status' => 200, 'questions1' => $questions1]);
            } else {
                return response()->json(['status' => 404]);
            }
        }
    }

    public function saveQuestions(Request $request)
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

    public function indexBlocks()
    {
        return view('admin.viewBlocks');
    }

    public function fetchAllBlocks(Request $request)
    {
        $blocks = DB::table('blocks as b')
            ->select('b.id', 'b.block_name','b.type', DB::raw("(SELECT COUNT(question_id) FROM block_questions
                    WHERE block_id = b.id GROUP BY b.id) as question_count"))
            ->whereNull('deleted_at')
            ->get();
        return DataTables::of($blocks)
            ->addIndexColumn()

            ->addColumn('action', function ($blocks) {
                return '<button id="show_block_btn" type="button" data-id="' . $blocks->id . '"
        class="btn btn-info"><i class="fa-solid fa-eye"></i>&nbsp;Show</button>
        <a href="/viewBlocks/destroy/' . $blocks->id . '"> <button id="show_block_btn" type="button"
        class="btn btn-danger"><i class="fa-solid fa-eye"></i>&nbsp;Delete</button></a>
        ';
            })
            ->setRowId('id')
            ->setRowClass(function ($blocks) {
                return $blocks->id % 2 == 0 ? 'alert-success' : 'alert-primary';
            })
            ->removeColumn('id')
            ->make(true);
    }

    public function restoreBlocks(Request $request)
    {
        $blocks = DB::table('blocks as b')
            ->select('b.id', 'b.block_name')
            ->whereNotNull('deleted_at')
            ->get();
        return DataTables::of($blocks)
            ->addIndexColumn()

            ->addColumn('action', function ($blocks) {
                return '
       <a href="/admin/restoreBlocks/' . $blocks->id . '"><button id="show_block_btn" type="button"
        class="btn btn-danger"><i class="fa-solid fa-eye"></i>&nbsp;Restore</button></a>
        ';
            })
            ->setRowId('id')
            ->setRowClass(function ($blocks) {
                return $blocks->id % 2 == 0 ? 'alert-success' : 'alert-primary';
            })
            ->removeColumn('id')
            ->make(true);
    }

    public function fetchBlockQuestions(Request $request, $id)
    {
        $limit = $request->limit;
        $ques_count = $request->ques_count;
        if ($ques_count == 0) {
            $offset = 0;
        } else {
            $offset = $ques_count * $limit;
            // dd($limit);
        }
        $blockMcqQuestions = "";
        $block_questions = "";

        $blockType = DB::table('blocks')->where('id',$id)->select('type')->value('type');
        if($blockType == 'MCQ'){
            $blockMcqQuestions = DB::table('block_questions as bq')->where('bq.block_id', $id)
            ->join('mcq_questions as mq', 'bq.question_id', '=', 'mq.id')
            ->select('mq.mcq_questions as question')
            ->offset($offset)->limit($limit)
            ->get();
        }else{
            $block_questions = DB::table('block_questions as bq')->where('bq.block_id', $id)
                ->join('questions as q', 'bq.question_id', '=', 'q.id')
                ->select('q.question')
                ->offset($offset)->limit($limit)
                ->get();
        }
        if ($block_questions != "" || $blockMcqQuestions != "" ) {
            return response()->json([
                'block' => $block_questions,
                'blockMcq' => $blockMcqQuestions,
                'status' => 200
            ]);
        }
        else{
            return response()->json([
                'status' => 404
            ]);
        }
    }

    public function fetchUsers(Request $request)
    {
        $limit = $request->limit;
        $users_count = $request->users_count;
        if ($users_count == 0) {
            $offset = 0;
        } else {
            $offset = $users_count * $limit;
            // dd($limit);
        }
        $users = DB::table('users as u')->where('u.role', '=', 'user')
            ->select('u.id', 'u.name', 'u.email', DB::raw("(SELECT block_id FROM userquizzes
                    WHERE status = 'P' && users_id= u.id) as block_id"))
            ->offset($offset)
            ->limit($limit)
            ->get();

        if (count($users) > 0) {
            return response()->json(['users' => $users, 'status' => 200]);
        } else {
            return response()->json(['status' => 404]);
        }
    }

    public function assignBlock(Request $request)
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
