<?php

namespace App\Http\Controllers;

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


        return view('user_edit', ['users' => $users, 'technologies' => $technologies]);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'phone_number' => $request->input('phone_number'),
            'last_company' => $request->input('last_company'),
            'designation' => $request->input('designation'),
            'experience' => $request->input('experience'),

        ];
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
        return redirect('/user_edit');
    }
}
