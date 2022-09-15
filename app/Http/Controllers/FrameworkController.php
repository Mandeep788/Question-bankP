<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class FrameworkController extends Controller
{

    public function index($id)
    {
        
        $frameworks= DB::table('frameworks as f')
                    ->join('technologies as t','t.id','=','f.technology_id')
                    ->where('f.technology_id','=',$id)
                    ->select('f.id','f.framework_name','f.technology_id','t.technology_name')
                    ->get();
        // return view('admin.technologies.index');
        if(count($frameworks)>0){
        return response()->json([
            'frameworks'=>$frameworks,
            'status' =>200
        ]);
        }else{
            $technology= DB::table('technologies')
                        ->where('id','=',$id)
                        ->select('id','technology_name')
                        ->get();

        return response()->json([
            'technology'=> $technology,
            'status'=> 404
        ]);

        }
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $framework_data = [
            'technology_id' => $request->frame_technology_id,
            'framework_name' => $request->framework_name,
            'framework_description' => $request->framework_description,
            "created_at" => carbon::now()
        ];
        // return response()->json($request);
        DB::table('frameworks')->insert($framework_data);
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
        $framework = DB::table('frameworks')->find($id);
        return response()->json($framework);
    }


    public function update(Request $request, $id)
    {
        // return response()->json($request);
        $tech_data = [
            // 'technology_id ' => $request->editframe_technology_id,
            'framework_name' => $request->edit_framework_name,
            'framework_description' => $request->edit_framework_description,
            "updated_at" => carbon::now()
        ];
        // dd($request);
        DB::table('frameworks')->where('id',$id)->update($tech_data);
        return response()->json([
            'status' => 200
        ]);
    }


    public function destroy($id)
    {
        $query = DB::table('frameworks')->find($id);
        // $emp= $query->first();
        if ($query) {
            DB::table('frameworks')->delete($query->id);
            // $emp->delete();
            return response()->json([
                'status' => 200
            ]);
        }
    }
}
