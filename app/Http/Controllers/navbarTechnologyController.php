<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class navbarTechnologyController extends Controller
{
    //
        public static function show()
    
    {
        $technologies = DB::table('technologies') ->whereBetween('id', [1,8])->get();
        // dd($technologies);
        $technologies2 = DB::table('technologies') ->whereBetween('id', [9,12])->get();
        $technologies3 = DB::table('technologies') ->whereBetween('id', [1,15])->get();
      
        return view('/dashboard', ['technologies' => $technologies,'technologies2'=>$technologies2,'technologies3'=> $technologies3]);
    }
}