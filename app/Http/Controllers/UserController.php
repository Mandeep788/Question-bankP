<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $technologies = DB::table('technologies')->orderBy('technology_name', 'asc')->get();
        return view('admin.ListUsers', ['technologies' => $technologies]);
    }
    public function getUsers()
    {
        $query = DB::table('users as u')
            ->select('u.id', 'u.name', 'u.email', 'u.role', 't.technology_name', 'u.designation', 'u.last_company', 'u.experience')
            ->where('u.role','user')
            ->LeftJoin('usertechnologies as ut', 'ut.users_id', '=', 'u.id')
            ->LeftJoin('technologies as t','t.id','=','ut.technology_id');
        return datatables($query)->make(true);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'name' => 'string|required|min:4',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:8'
        ]);
        if ($validate->passes()){
            $values = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ];
            $query = DB::table('users')->insert($values);
            if ($query) {
                $id = DB::table('users')->select('id')->where('name', $request->name)->value('id');
                $technology_data = [
                    'users_id' => $id,
                    'technology_name' => $request->technology_name,
                    'designation' => $request->designation,
                    'current_company' => $request->current_company,
                    'last_company' => $request->last_company,
                    'experience'=>$request->experience,
                ];
                $query2=DB::table('usertechnology')->insert($technology_data);
                if($query2){
                    return response()->json(['status' => 200]);
                }
            }
        } else{
            return response()->json(['status' => 409, 'errors' => $validate->errors()->toArray()]);
        }
    }

    public function assessmentIndex($id)
    {
        $submittedblock = DB::table('userquizzes as uq')
            ->join('users as u', 'u.id', '=', 'uq.users_id')
            ->join('blocks as b', 'b.id', '=', 'uq.block_id')
            ->where([
                ['uq.status', 'Submitted'],
                ['uq.id', $id],
            ])
            ->select('uq.id', 'u.name', 'b.block_name', 'uq.submitted_at')
            ->get();
        return view('admin.userassessment', ['submittedblock' => $submittedblock]);
    }

    public function getSubmittedBlock(Request $request)
    {
        $id = $request->id;

        $submitted_data = DB::table('userquizzes as uq')
            ->join('user_assessments as ua','uq.users_id','=','ua.users_id')
            ->join('block_questions as bq','bq.id','=','ua.block_question_id')
            ->join('questions as q', 'q.id', '=', 'bq.question_id')
            ->where([
                ['uq.id', $id],
            ])
            ->select('ua.users_id','uq.id', 'q.question', 'ua.answer', 'ua.id as question_id')
            ->get();
        if ($submitted_data) {
            if (count($submitted_data) > 0) {
                return response()->json(['submitted_data' => $submitted_data, 'status' => 200]);
            } else {
                return response()->json(['status' => 404]);
            }
        }else{
            return response()->json(['message'=>'Query Failed','status' => 404]);
        }
    }
    public function insertIndividualMarks(Request $request){
       $quiz_id=$request->quiz_id;
       $ques_id=$request->ques_id;
       $single_mark=$request->single_mark;
       $data=[
        'marks_per_ques'=>$single_mark
       ];
       $query=DB::table('user_assessments')->where('id',$ques_id)->update($data);
    }
    
}