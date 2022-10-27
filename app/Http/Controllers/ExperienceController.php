<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ExperienceController extends Controller
{

    public function index()
    {
        $experiences = DB::table('experiences')->get();
        return response()->json([
            'experience'=>$experiences,
            'status' =>200
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $experience_data = [
            'experience_name' => $request->experience_name,
            "created_at" => carbon::now()
        ];
        // return response()->json($request);
        DB::table('experiences')->insert($experience_data);
        return response()->json([
            'status' => 200
        ]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $experience = DB::table('experiences')->find($id);
        return response()->json($experience);
    }


    public function update(Request $request, $id)
    {
        $experience_data = [

            'experience_name' => $request->edit_experience_name,
            "updated_at" => carbon::now()
        ];

        DB::table('experiences')->where('id',$id)->update($experience_data);
        return response()->json([
            'status' => 200
        ]);
    }


    // public function destroy($id)
    // {
    //     $query = DB::table('experiences')->find($id);
    //     if ($query) {
    //         DB::table('experiences')->delete($query->id);
    //         return response()->json([
    //             'status' => 200
    //         ]);
    //     }
    // }
}
