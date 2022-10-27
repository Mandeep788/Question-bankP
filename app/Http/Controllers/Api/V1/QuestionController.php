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
    public function index(Request $request, $frameworkId, $experienceId)
    {
        try {
            $experienceId = $request->experienceId;
            $frameworkId = $request->frameworkId;
            $limitPerPage = $request->limitPerPage;
            $loaderCount = $request->loaderCount;

            if ($loaderCount == 0) {
                $offset = 0;
            } else {
                $offset = $loaderCount * $limitPerPage;
            }
            if (!($limitPerPage || $loaderCount)) {
                if ($experienceId == 0) {
                    $questionAnswer = DB::table('answers as a')
                        ->join('questions as q', 'q.id', '=', 'a.question_id')
                        ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                        ->where([
                            ['q.framework_id', $frameworkId]
                        ])
                        ->select('q.question', 'a.question_id as questionId', 'a.answer')
                        ->get();
                } else {
                    $questionAnswer = DB::table('answers as a')
                        ->join('questions as q', 'q.id', '=', 'a.question_id')
                        ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                        ->where([
                            ['q.experience_id', $experienceId],
                            ['q.framework_id', $frameworkId]
                        ])
                        ->select('q.question', 'a.question_id as questionId', 'a.answer')
                        ->get();
                }
            } else {
                if ($experienceId == 0) {
                    $questionAnswer = DB::table('answers as a')
                        ->join('questions as q', 'q.id', '=', 'a.question_id')
                        ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                        ->where([
                            ['q.framework_id', $frameworkId]
                        ])
                        ->select('q.question', 'a.question_id as questionId', 'a.answer')
                        ->offset($offset)->limit($limitPerPage)
                        ->get();
                } else {
                    $questionAnswer = DB::table('answers as a')
                        ->join('questions as q', 'q.id', '=', 'a.question_id')
                        ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                        ->where([
                            ['q.experience_id', $experienceId],
                            ['q.framework_id', $frameworkId]
                        ])
                        ->select('q.question', 'a.question_id as questionId', 'a.answer')
                        ->offset($offset)->limit($limitPerPage)
                        ->get();
                }
            }
            if (count($questionAnswer) == 0) {
                return response()->json(['message' => 'No record found'], 404);
            }
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json([
            'questionAnswer' => $questionAnswer
        ], 200);
    }

    // Add Question
    public function store(Request $request)
    {
        if (!isset($request->frameworkId)) {
            return response()->json(['message' => ' Framework id is required'], 400);
        }
        if (!isset($request->experienceId)) {
            return response()->json(['message' => ' Experience id is required'], 400);
        }
        if (!isset($request->question)) {
            return response()->json(['message' => ' Question is required'], 400);
        }
        if (!isset($request->answer)) {
            return response()->json(['message' => ' Answer is required'], 400);
        }
        try {
            $questionData = [
                'framework_id' => $request->frameworkId,
                'experience_id' => $request->experienceId,
                'question' => $request->question,
                "created_at" => carbon::now()
            ];

            $insertedQuestion = DB::table('questions')->insert($questionData);
            $insertedQuestionId = DB::getPdo()->lastInsertId();
            if ($insertedQuestion) {
                $answerData = [
                    'question_id' => $insertedQuestionId,
                    'answer' => $request->answer,
                    "created_at" => carbon::now()
                ];
                $insertedAnswer = DB::table('answers')->insert($answerData);
                if ($insertedAnswer) {
                    $InsertedQuestionAnswer = DB::table('answers as a')
                        ->join('questions as q', 'q.id', '=', 'a.question_id')
                        ->where('a.question_id', $insertedQuestionId)
                        ->select('q.question', 'a.question_id as questionId', 'a.answer')
                        ->first();
                }
            }
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json([
            'data' => $InsertedQuestionAnswer
        ], 200);
    }

    //Fetch for editing
    public function edit($id)
    {
        try {
            $questionAnswer = DB::table('answers as a')
                ->join('questions as q', 'q.id', '=', 'a.question_id')
                ->where('a.question_id', $id)
                ->select('q.question', 'a.question_id as questionId', 'a.answer')
                ->first();
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        if (!$questionAnswer) {
            return response()->json(['message' => 'No record found for question id ' . $id], 404);
        }
        return response()->json(['data' => $questionAnswer], 200);
    }

    //Update Question Answer
    public function update(Request $request, $id)
    {
        if (!isset($request->question)) {
            return response()->json(['message' => ' Question is required'], 400);
        }
        if (!isset($request->answer)) {
            return response()->json(['message' => ' Answer is required'], 400);
        }
        try {
            $Question_data = [
                'question' => $request->question,
                "updated_at" => carbon::now()
            ];
            DB::table('questions')->where('id', '=', $id)->update($Question_data);
            $Answer_data = [
                'answer' => $request->answer,
                "updated_at" => carbon::now()
            ];
            DB::table('answers')->where('question_id', '=', $id)->update($Answer_data);

            $updatedQuestionAnswer = DB::table('questions as q')
                ->join('answers as a', 'q.id', '=', 'a.question_id')
                ->where('q.id', $id)
                ->select('q.id as questionId', 'q.question', 'a.answer', 'a.updated_at as updatedAt')
                ->get();
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json([
            'data' => $updatedQuestionAnswer
        ], 200);
    }

    //Delete Question Answer
    public function destroy($id)
    {
        try {
            $query = DB::table('questions')->find($id);
            if (!$query) {
                return response()->json([
                    'message' => 'No record found for technology id ' . $id
                ], 404);
            }
            DB::table('questions')->delete($query->id);
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json([
            'message' => 'Question Answer deleted successfully'
        ], 200);
    }
}
