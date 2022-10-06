<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Pdf;

class MailController extends Controller
{
    public function Mail($id){
        // dd($id);

        $details = DB::table('userquizzes as uq')
        ->join('blocks as b','b.id','=','uq.block_id')
        ->join('users as u','u.id','=','uq.users_id')
        ->where([
            ['uq.id', $id],
        ])
        ->select('u.name','b.block_name','u.email','uq.id')
        ->get();
        // dd($details);
        // return view('admin.notifications',['details'=>$details]);
        if(count($details)>0)
        {
            return response()->json([
                "status"=>200,
                'details'=>$details
            ]);
        }
        else{
            return response()->json([
                "status"=>404,
                "message"=>"data not found"
            ]);

        }

    }
    public function sendMail(Request $request)
    {
        // dd($request()->all());
        $id=$request->id;
        $email=$request->email;
        $name=$request->name;
        $blockName=$request->block_name;
        $subject=$request->subject;
        // dd($subject);

            $data = DB::table('userquizzes as uq')
            ->join('user_assessments as ua','uq.id','=','ua.quiz_id')
            ->join('block_questions as bq','bq.id','=','ua.block_question_id')
            ->join('questions as q', 'q.id', '=', 'bq.question_id')
            ->where([
                ['uq.id', $id],
            ])
            ->select('q.question', 'ua.answer', 'ua.marks_per_ques')
            ->get();


        $userdata = DB::table('userquizzes as uq')
            ->join('blocks as b','b.id','=','uq.block_id')
            ->join('users as u','u.id','=','uq.users_id')
            ->where([
                ['uq.id', $id],
            ])
            ->select('u.name','b.block_name','uq.block_aggregate','uq.feedback',DB::raw("(SELECT name FROM users
            WHERE id = b.admin_id) as admin_name"))
            ->get();

        $pdf = Pdf::loadView('PDF.viewPdf',['data'=>$data,'userdata'=>$userdata])
        ->setPaper('a4', 'portrait');
        Mail::send('PDF.viewPdf',['data'=>$data,'userdata'=>$userdata], function($message)use($request, $pdf) {
            $message->to($request->email)
                    ->subject($request->subject)
                    ->attachData($pdf->output(), "text.pdf");
        });
    }



}
