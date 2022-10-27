<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class NavBarController extends Controller
{
    public static function show()

    {
        $technologies = DB::table('technologies') ->offset(0)->limit(7)->get();
        $technologies2 = DB::table('technologies') ->offset(3)->limit(4)->get();
        $technologies3 = DB::table('technologies')->get();
        //dd($technologies);
        // return view('/dashboard', ['technologies' => $technologies,'technologies2'=>$technologies2,'technologies3'=> $technologies3]);
        return response($technologies3);
    }
}
