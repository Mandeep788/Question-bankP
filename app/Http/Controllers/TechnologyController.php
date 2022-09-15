<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;



class TechnologyController extends Controller
{

    public function index()
    {
        return view('admin.technologies.index');
    }


    public function create(Request $request)
    {
        $tech_data = [
            'technology_name' => $request->technology_name,
            'technology_description' => $request->technology_description,
            "created_at" => carbon::now()
        ];
        // dd($request);
        DB::table('technologies')->insert($tech_data);
        return response()->json([
            'status' => 200
        ]);
    }

    // Fetch all Technologies
    public function show()
    {
        $technologies = DB::table('technologies')->get();
        //    dd($technologies);
        return view('admin.technologies.index', ['technologies' => $technologies]);
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $technology = DB::table('technologies')->find($id);
        return response()->json($technology);
    }


    public function update(Request $request)
    {
        $tech_data = [
            'technology_name' => $request->edit_technology_name,
            'technology_description' => $request->edit_technology_description,
            "updated_at" => carbon::now()
        ];
        // dd($request);
        DB::table('technologies')->where('id',$request->technology_id)->update($tech_data);
        return response()->json([
            'status' => 200
        ]);
        // return view('admin.technologies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $id = $request->id;
        $query = DB::table('technologies')->find($id);
        // $emp= $query->first();
        if ($query) {
            DB::table('technologies')->delete($query->id);
            // $emp->delete();
            return response()->json([
                'status' => 200
            ]);
        }
    }
}
