<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class navbarTechnologyController extends Controller
{
    //
        public static function show()
    
    {
        $technologies = DB::table('technologies') ->whereBetween('id', [1,10])->get();
        // dd($technologies);
        $frameworks = DB::table('frameworks') ->whereBetween('id', [1,11])->get();
        $technologies3 = DB::table('technologies') ->whereBetween('id', [1,15])->get();
      
        return view('/dashboard', ['technologies' => $technologies,'frameworks'=>$frameworks,'technologies3'=> $technologies3]);
    }
}