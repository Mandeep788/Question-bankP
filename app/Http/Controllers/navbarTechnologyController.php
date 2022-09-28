<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class navbarTechnologyController extends Controller
{
    //
        public static function show()
    
    {
        $sliders = DB::table('slider')->get();

        $technologies = DB::table('technologies') ->whereBetween('id', [1,8])->get();
        $technologies2 = DB::table('technologies') ->whereBetween('id', [9,12])->get();
        $technologies3 = DB::table('technologies')->get();
        //dd($technologies);
        return view('/dashboard', ['technologies' => $technologies,'technologies2'=>$technologies2,'technologies3'=> $technologies3,'sliders'=>$sliders]);
    }
    public function insert(Request $request){
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename= $file->getClientOriginalName();
            $uniq_no= mt_rand();
            $unique_image= $uniq_no.'image'.$filename;
            $move= $file->move(public_path().'/img', $unique_image);
            if($move){
                $record = DB::table('sliders')->where('id', $id)->first();
                $file= $record->image;
                $filename = public_path().$file;
                File::delete($filename);
            }
            $data['image'] = "/img/".$unique_image;
        }    
    }
}
