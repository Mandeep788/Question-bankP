<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\technology;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Framework;

class TechnologiesSecondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('user.index', [
    //         'users' => DB::table('users')->paginate(15)
    //     ]);
    // }
    public function show(Request $request)
    {
        $FrameworkId=$request->FrameworkId;
        // $ExperienceId=$request->ExperienceId;

        $frameworks = DB::table('frameworks')
            ->join('questions','frameworks.id','=','questions.framework_id')
            ->join('answers','questions.id','=','answers.question_id')

        
        //   $frameworks=  $frameworks->where('frameworks.id',$FrameworkId);
       
        
            ->select('frameworks.id','questions.question','answers.answer')->paginate(10);
         
            $ans_id = DB::table('answers')->get();
            $technologies = DB::table('technologies')->get();
            return view('technologies_second',['technologies'=>$technologies, 'frameworks'=>$frameworks, 'answers'=>$ans_id]);      
    }

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function GetQuestionsByExperience($id,$exp){
        $frameworks = DB::table('frameworks')
            ->join('questions','frameworks.id','=','questions.framework_id')
            ->join('answers','questions.id','=','answers.question_id');

        if($exp==0){
          $frameworks=  $frameworks->where('frameworks.id',$id);
        }else{
          $frameworks=  $frameworks->where([
            ['frameworks.id',$id],
            ['experience_id',$exp]
        ]);
        }
         $frameworks=   $frameworks->select('frameworks.id','questions.question','answers.answer')->paginate(10);
        if($frameworks){
            $technologies = DB::table('technologies')->get();
            return view('technologies_second',['technologies'=>$technologies, 'frameworks'=>$frameworks]);    
        }

    }
}
