<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserTechnology extends Controller
{
    public function index($id){
        
        $tech2=DB::table('technologies')->where('id',$id)->get();
      return response()-> json($tech2);
    }
    public function show($id2){
    $technologies = DB::table('technologies')->whereBetween('id', [1,8])->get();
    $technology2=DB::table('technologies')->whereBetween('id',[3,6])->get();    
    $frame2=DB::table('frameworks')->where('technology_id',$id2)->get();

   // dd($frame2);
   return view('user.technologies_second',['technologies'=>$technologies,'technologies2'=>$technology2,'frame2'=>$frame2]);
    }
}
