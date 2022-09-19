<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $query = DB::table('users as u')
        ->select('u.id', 'u.name', 'u.email', 'u.designation', 'u.last_company', 'u.experience')
        ->where('u.role', 'user')
        ->get();

        $users = array();
        foreach($query as $key=> $userTech)
        {
            $array['id'] = $userTech->id;
            $array['name'] = $userTech->name;
            $array['email'] = $userTech->email;
            $array['designation'] = $userTech->designation;
            $array['last_company'] = $userTech->last_company;
            $array['experience'] = $userTech->experience;
            $array['technology_name'] = $this->getUserTech($userTech->id);
            $users[] = $array;
        }
      $technologies = DB::table('technologies')->orderBy('technology_name', 'asc')->get();
        return view('admin.ListUsers', ['technologies' => $technologies,'users'=>$users]);
    }


    public function getUserTech($user_id)
    {
        $query = DB::table('usertechnologies as ut')
        ->select('t.technology_name')
        ->where('ut.users_id',$user_id)
        // ->where('u.role', 'user')
        ->join('technologies as t', 't.id', '=', 'ut.technology_id')->get('technology_name');
        $i=0;
        if(count($query)>0){
            foreach($query as $key=> $userTech){
                $std[$i]=$userTech->technology_name;
                $i++;
            }
            $technologies=implode(',',$std);
        }else{
            $technologies='';
        }
        return $technologies;

    }
    public function getUsers()
    {





    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'name' => 'string|required|min:4',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:8'
        ]);
        if ($validate->passes()) {
            $values = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'designation' => $request->designation,
                'current_company' => $request->current_company,
                'last_company' => $request->last_company,
                'experience' => $request->experience,
            ];
            $query = DB::table('users')->insert($values);
            if ($query) {
                $id = DB::table('users')->select('id')->where('name', $request->name)->value('id');

                $technologies_id = $request->technologies_id;
                $technologies_ids = explode(", ", $technologies_id);
                $technology_data = array();
                foreach ($technologies_ids as $technology_id) {
                    if ($technology_id != "") {
                        $technology_data[] = array(
                            'users_id' => $id,
                            'technology_id' => $technology_id
                        );
                    }
                }
                $query2 = DB::table('usertechnologies')->insert($technology_data);
                if ($query2) {
                    return response()->json(['status' => 200]);
                } else {
                    return response()->json(['status' => 404]);
                }
            }
        } else {
            return response()->json(['status' => 409, 'errors' => $validate->errors()->toArray()]);
        }
    }

    public function assessmentIndex($id)
    {

        DB::table('userquizzes')->where('status','S')->update(['status'=>'U']);
        $submittedblock = DB::table('userquizzes as uq')
            ->join('users as u', 'u.id', '=', 'uq.users_id')
            ->join('blocks as b', 'b.id', '=', 'uq.block_id')
            ->where([
                ['uq.status', 'S'],
                ['uq.id', $id],
            ])
            ->orWhere([
                ['uq.status', 'U'],
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
        // $quiz_id=$request->quiz_id;
        $ques_id=$request->ques_id;
        $single_mark=$request->single_mark;
        $data=[
         'marks_per_ques'=>$single_mark
        ];
        $query=DB::table('user_assessments')->where('id',$ques_id)->update($data);
        if($query){
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>404]);

        }
     }

     public function feedbackBlock(Request $request){
        $QuizId=$request->QuizId;
        $Aggergate=$request->Aggergate;
        // $Feedback=$request->Feedback;

        $data=[
            'block_aggregate'=>$Aggergate,
            // 'feedback'=>$Feedback,
            'status'=>'C',
        ];

        $query=DB::table('userquizzes')->where('id',$QuizId)->update($data);
        if($query){
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>404]);
        }

     }
     public function feedbackData(Request $request){
        $quizId=$request->quizId;
        $feedback=$request->feedback;

        $data=[
            'feedback'=>$feedback,
        ];

        $query=DB::table('userquizzes')->where('id',$quizId)->update($data);
        if($query){
            return response()->json(['status'=>200]);
        }else{
            return response()->json(['status'=>404]);
        }

     }
}
