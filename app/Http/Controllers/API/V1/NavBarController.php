<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class NavBarController extends Controller
{
    public static function show()

    {
        // $technologies = DB::table('technologies') ->offset(0)->limit(7)
        // ->select('technologies.id as id','technologies.technology_name as technologyName','technologies.technology_description as technologyDescription')
        // ->get();
        // $technologies2 = DB::table('technologies') ->offset(3)->limit(4)
        // ->select('technologies.id as id','technologies.technology_name as technologyName','technologies.technology_description as technologyDescription')
        // ->get();
        $technologies = DB::table('technologies')
        ->select('technologies.id as id','technologies.technology_name as technologyName','technologies.technology_description as technologyDescription')
        ->get();
        //dd($technologies);
        return response( ['technologies'=> $technologies]);
        // return response($technologies3);
    }
}
