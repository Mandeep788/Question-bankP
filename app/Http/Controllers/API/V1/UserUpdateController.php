<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserUpdateController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $technologies = DB::table('technologies')->whereBetween('id', [1, 10])->get();
        $users = DB::table('users')->where('id', $id)->get();
        //dd($users);
        //$user = App\User::where('id',$id)->first();


        // return view('user_edit', ['users' => $users, 'technologies' => $technologies]);
        return response($users);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'last_company' => $request->last_company,
            'designation' => $request->designation,
            'experience' => $request->experience,

        ];
        // return response($data);
        // $image=$request->input('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $uniq_no = mt_rand();
            $unique_image = $uniq_no . 'image' . $filename;
            $move = $file->move(public_path() . '/img', $unique_image);
            if ($move) {
                $record = DB::table('users')->where('id', $id)->first();
                $file = $record->image;
                $filename = public_path() . $file;
                File::delete($filename);
            }
            $data['image'] = "/img/" . $unique_image;
        }

        DB::table('users')
            ->where('id', '=', $id)
            ->update($data);

        $technologies_id = $request->userTechnology;
        if (!empty($technologies_id)) {
            foreach ($technologies_id as $technology) {
                if ($technology != "") {
                    $technology_data[] = array(
                        'users_id' => $id,
                        'technology_id' => $technology
                    );
                }
            }
            $existingTechnologies=DB::table('usertechnologies')->where('users_id', $id)->get();
            if(count($existingTechnologies)>0){
                $deleteQuery = DB::table('usertechnologies')->where('users_id', $id)->delete();
            }
            DB::table('usertechnologies')->insert($technology_data);
        }
        // return redirect('/user_edit');
        return response([
            'message'=>'Update successfully',
        ],200);
    }
}
