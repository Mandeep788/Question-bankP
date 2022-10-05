<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class mcqQuestions extends Controller
{
    public function index(){
         $technologies = DB::table('technologies')->get();
         //dd($technologies);
         return view('admin.mcq_questions',['technologies'=>$technologies]);
    }
    public function show(Request $request){
       $technology_id= $request->technology_id;
       //dd($technology_id);
        $frameworks = DB::table('frameworks')
        ->where('technology_id',$technology_id)->get();
        // dd($frameworks);
       return response()->json([
        'technology_id'=>$frameworks,
        'status'=>200
       ]);
    }
}
