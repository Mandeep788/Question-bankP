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


    public function store(Request $request)
    {
    }

    // Fetch all Technologies

    public function show()
    {
        $technologies = DB::table('technologies')->get();
        //    dd($technologies);

        return view('admin.technologies.index', ['technologies' => $technologies]);
    }


    public function edit($id)
    {
        $technology = DB::table('technologies')->find($id);
        return view('admin.technologies.edit', ['Technology' => $technology]);
    }


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
}
