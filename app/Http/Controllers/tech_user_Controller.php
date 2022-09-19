<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tech_user_Controller extends Controller
{
    //request
    public function index($id)

    {
      $tech=DB::table('technologies')->where('id',$id)->get();
      return response()->json($tech);

    }
    public function show($id){

        // $tech=DB::table('technologies')->where('id',$id)->get();
        $technologies = DB::table('technologies')->whereBetween('id', [1,10])->get();
        $frame1=DB::table('frameworks')->where('technology_id',$id)->get();
        // print "<pre>";
        // print_r($frame1);
        // exit();
        $countFrame=count($frame1);
if($countFrame>0)
{
  return view('user.technology',['technologies'=>$technologies,'frame1'=>$frame1]);
}
else{

  return view('user.technology',['technologies'=>$technologies,'countFrame'=>$countFrame]);
  
}

    }

    // fetching query of question and answer fetching**********************************************

    public function getQuestion(Request $request)
    {

          $fid=$request->fid;
          $techid=$request->tech_id;
          $exp_id=$request->experience_id;
          $limit= $request->limit;
          $count= $request->count;
          if ($count == 0) {
              $offset = 0;
        } else {
            $offset = $count * $limit;
        }
            if($exp_id==0)
            {
              // dd($exp_id);
              $d=DB::table('questions as q')
              ->join('answers as a','a.question_id','=','q.id')
              ->join('frameworks as f','f.id','=','q.framework_id')
              ->where([
                ['q.framework_id',$fid],
                ['f.technology_id',$techid]
            ]);
            // dd($d);
            }
        else
           {
              $d=DB::table('questions as q')
              ->join('answers as a','a.question_id','=','q.id')
              ->join('frameworks as f','f.id','=','q.framework_id')
              ->where([
                  ['q.framework_id',$fid] ,
                  ['f.technology_id',$techid],
                  ['q.experience_id',$exp_id]
              ]);
              // dd($d);
            }
             $d=$d->select('q.question','a.question_id','a.answer') ->offset($offset)->limit($limit)
             ->get();

              //  dd($d);
              if(count($d)>0){
                return response()->json([
                  'ques'=>$d,
                  'status'=>200
                ]);
              }
              else{
                return response()->json([

                  'status'=>404
                ]);



            }


    }
// end that code************************************

}
