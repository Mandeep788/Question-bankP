<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Pdf;

class UserController extends Controller
{
    public function index()
    {
        $technologies = DB::table('technologies')->orderBy('technology_name', 'asc')->get();
        return view('admin.ListUsers', ['technologies' => $technologies]);
    }


    public function getUsers()
    {
        try {
            $query = DB::table('users')
                ->select('id', 'name', 'email', 'designation', 'last_company as lastCompany', 'experience')
                ->where('role', 'user')
                ->get();

            $getUsers = array();
            foreach ($query as $key => $user) {
                $array['id'] = $user->id;
                $array['name'] = $user->name;
                $array['email'] = $user->email;
                $array['designation'] = $user->designation;
                $array['lastCompany'] = $user->lastCompany;
                $array['experience'] = $user->experience;
                $array['technologyiesId'] = $this->getTechnologiesId($user->id);
                $array['technologies'] = $this->getTechnologies($user->id);

                $getUsers[] = $array;
            }
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json(['data' => $getUsers], 200);
    }

    public function getTechnologies($id)
    {
        $query = DB::table('usertechnologies as ut')
            ->select('t.technology_name')
            ->where('ut.users_id', $id)
            ->join('technologies as t', 't.id', '=', 'ut.technology_id')->get('technology_name');
        $i = 0;
        if (count($query) > 0) {
            foreach ($query as $key => $userTech) {
                $std[$i] = $userTech->technology_name;
                $i++;
            }
            $technologies = implode(',', $std);
        } else {
            $technologies = '';
        }
        return $technologies;
    }

    public function getTechnologiesId($id)
    {
        $query = DB::table('usertechnologies as ut')
            ->select('t.id')
            ->where('ut.users_id', $id)
            ->join('technologies as t', 't.id', '=', 'ut.technology_id')->get('id');
        $i = 0;
        if (count($query) > 0) {
            foreach ($query as $key => $userTech) {
                $std[$i] = $userTech->id;
                $i++;
            }
            $technologies = implode(',', $std);
        } else {
            $technologies = '';
        }
        return $technologies;
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'string|required|min:4',
                'email' => 'string|email|required|max:100|unique:users',
                'password' => 'string|required|confirmed|min:8',
                'role' => 'required',
                'designation' => 'required',
                'currentCompany' => 'required',
                'lastCompany' => 'required',
                'experience' => 'required',
                'technologiesId' => 'required',
            ]);
            if ($validate->passes()) {
                $values = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => $request->role,
                    'designation' => $request->designation,
                    'current_company' => $request->currentCompany,
                    'last_company' => $request->lastCompany,
                    'experience' => $request->experience,
                ];
                $query = DB::table('users')->insert($values);
                $id = DB::getPdo()->lastInsertId();
                if ($query) {
                    $technologiesId = $request->technologiesId;
                    $technologiesIds = explode(", ", $technologiesId);
                    $technologyData = array();
                    foreach ($technologiesIds as $technologyId) {
                        if ($technologyId != "") {
                            $technologyData[] = array(
                                'users_id' => $id,
                                'technology_id' => $technologyId
                            );
                        }
                    }
                    $query2 = DB::table('usertechnologies')->insert($technologyData);
                    if (!$query2) {
                        return response()->json(['message' => 'Something went wrong...'], 404);
                    } else {
                        $data = DB::table('users')
                            ->select('id', 'name', 'email', 'designation', 'last_company as lastCompany', 'experience')
                            ->where('id', $id)
                            ->get();

                        $insertedData = array();
                        foreach ($data as $key => $user) {
                            $array['id'] = $user->id;
                            $array['name'] = $user->name;
                            $array['email'] = $user->email;
                            $array['designation'] = $user->designation;
                            $array['lastCompany'] = $user->lastCompany;
                            $array['experience'] = $user->experience;
                            $array['technologies'] = $this->getTechnologies($user->id);

                            $insertedData[] = $array;
                        }
                    }
                }
            } else {
                return response()->json(['errors' => $validate->errors()->toArray()], 409);
            }
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json(['data' => $insertedData], 200);
    }
    public function assessmentIndex($quizId)
    {
        try {
            DB::table('userquizzes')->where('status', 'S')->update(['status' => 'U']);
            $submittedblock = DB::table('userquizzes as uq')
                ->join('users as u', 'u.id', '=', 'uq.users_id')
                ->join('blocks as b', 'b.id', '=', 'uq.block_id')
                ->where([
                    ['uq.status', 'S'],
                    ['uq.id', $quizId],
                ])
                ->orWhere([
                    ['uq.status', 'U'],
                    ['uq.id', $quizId],
                ])
                ->select('uq.id', 'u.name', 'b.block_name', 'uq.submitted_at')
                ->get();
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json(['data' => $submittedblock], 200);
    }

    public function getSubmittedBlock(Request $request)
    {
        try {
            $quizId = $request->quizId;

            $submittedData = DB::table('userquizzes as uq')
                ->join('user_assessments as ua', 'uq.id', '=', 'ua.quiz_id')
                ->join('block_questions as bq', 'bq.id', '=', 'ua.block_question_id')
                ->join('questions as q', 'q.id', '=', 'bq.question_id')
                ->where([
                    ['ua.quiz_id', $quizId],
                ])
                ->select('ua.users_id', 'uq.id', 'q.question', 'ua.answer', 'ua.id as question_id', DB::raw("(SELECT COUNT(question_id) FROM block_questions
                WHERE block_id = uq.block_id GROUP BY uq.block_id) as question_count"))
                ->get();

            if ($submittedData) {
                if (count($submittedData) > 0) {
                    return response()->json(['submitted_data' => $submittedData, 'status' => 200]);
                } else {
                    return response()->json(['status' => 404]);
                }
            } else {
                return response()->json(['message' => 'Query Failed', 'status' => 404]);
            }
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
    }

    public function insertIndividualMarks(Request $request)
    {
        try {
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        $ques_id = $request->ques_id;
        $single_mark = $request->single_mark;
        $data = [
            'marks_per_ques' => $single_mark
        ];
        $query = DB::table('user_assessments')->where('id', $ques_id)->update($data);
        if ($query) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 404]);
        }
    }

    public function feedbackBlock(Request $request)
    {
        try {
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        $QuizId = $request->QuizId;
        $Aggergate = $request->Aggergate;
        // $Feedback=$request->Feedback;

        $data = [
            'block_aggregate' => $Aggergate,
            // 'feedback'=>$Feedback,
            'status' => 'C',
        ];

        $query = DB::table('userquizzes')->where('id', $QuizId)->update($data);
        if ($query) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 404]);
        }
    }

    // Feedback Updation
    public function feedbackData(Request $request)
    {
        try {
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        $quizId = $request->quizId;
        $feedback = $request->feedback;

        $data = [
            'feedback' => $feedback,
        ];

        $query = DB::table('userquizzes')->where('id', $quizId)->update($data);
        if ($query) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 404]);
        }
    }

    //PDF View Functionality
    public function viewPDF($id)
    {
        try {
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }

        $data = DB::table('userquizzes as uq')
            ->join('user_assessments as ua', 'uq.id', '=', 'ua.quiz_id')
            ->join('block_questions as bq', 'bq.id', '=', 'ua.block_question_id')
            ->join('questions as q', 'q.id', '=', 'bq.question_id')
            ->where([
                ['uq.id', $id],
            ])
            ->select('q.question', 'ua.answer', 'ua.marks_per_ques')
            ->get();


        $userdata = DB::table('userquizzes as uq')
            ->join('blocks as b', 'b.id', '=', 'uq.block_id')
            ->join('users as u', 'u.id', '=', 'uq.users_id')
            ->where([
                ['uq.id', $id],
            ])
            ->select('u.name', 'b.block_name', 'uq.block_aggregate', 'uq.feedback', DB::raw("(SELECT name FROM users
            WHERE id = b.admin_id) as admin_name"))
            ->get();


        $pdf =   Pdf::loadView('PDF.viewPdf', ['data' => $data, 'userdata' => $userdata])
            ->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    //PDF Download Functionality
    public function downloadPDF($id)
    {
        try {
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }

        $data = DB::table('userquizzes as uq')
            ->join('user_assessments as ua', 'uq.id', '=', 'ua.quiz_id')
            ->join('block_questions as bq', 'bq.id', '=', 'ua.block_question_id')
            ->join('questions as q', 'q.id', '=', 'bq.question_id')
            ->where([
                ['uq.id', $id],
            ])
            ->select('q.question', 'ua.answer', 'ua.marks_per_ques')
            ->get();


        $userdata = DB::table('userquizzes as uq')
            ->join('blocks as b', 'b.id', '=', 'uq.block_id')
            ->join('users as u', 'u.id', '=', 'uq.users_id')
            ->where([
                ['uq.id', $id],
            ])
            ->select('u.name', 'b.block_name', 'uq.block_aggregate', 'uq.feedback', DB::raw("(SELECT name FROM users
            WHERE id = b.admin_id) as admin_name"))
            ->get();


        $pdf =   Pdf::loadView('PDF.viewPdf', ['data' => $data, 'userdata' => $userdata])
            ->setPaper('a4', 'portrait');
        return $pdf->download('Question-bank.pdf');
    }
}
