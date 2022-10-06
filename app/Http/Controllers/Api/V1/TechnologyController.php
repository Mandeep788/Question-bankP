<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;




class TechnologyController extends Controller
{

    public function create(Request $request)
    {
        try {

            $tech_data = [
                'technology_name' => $request->technology_name,
                'technology_description' => $request->technology_description,
                "created_at" => carbon::now()
            ];
            // dd($request);
            DB::table('technologies')->insert($tech_data);
            $id = DB::getPdo()->lastInsertId();
        } catch (QueryException $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 404);
        }
        return response()->json([
            'insertedId' => $id
        ], 200);
    }

    // Fetch all Technologies
    public function show()
    {
        try{
            $technologies = DB::table('technologies')->get();
        }catch(QueryException $ex){
            return response()->json(['message' => 'No technology found'], 404);
        }
        // if(!$technologies){

        // }
            return response()->json(['technologies' => $technologies], 200);
    }

    public function edit($id)
    {
        try{

            $technology = DB::table('technologies')->find($id);
        }catch(QueryException $ex){
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        if(!$technology){
            return response()->json(['message' => 'No record found for technology id '.$id], 404);
        }
            return response()->json([$technology], 200);
    }


    public function update($id, Request $request)
    {


        try{
            $techData = [
                'technology_name' => $request->technologyName,
                'technology_description' => $request->technologyDescription,
                "updated_at" => carbon::now()
            ];
            // dd($request);
            $updateQuery = DB::table('technologies')->where('id', $id)->update($techData);
        }catch(QueryException $ex){
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        if ($updateQuery) {
            return response()->json([
                'message' => 'Technology updated successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Technology updation unsuccessful'
            ], 404);
        }
        // return view('admin.technologies.index');
    }

    public function destroy(Request $request, $id)
    {

        $id = $request->id;
        $query = DB::table('technologies')->find($id);
        // $emp= $query->first();
        if ($query) {
            $deleteQuery = DB::table('technologies')->delete($query->id);
            if ($deleteQuery) {
                return response()->json([
                    'message' => 'Technology deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Technology is not deleted'
                ], 404);
            }
            // $emp->delete();
        } else {
            return response()->json([
                'message' => 'No record found'
            ], 404);
        }
    }
}
