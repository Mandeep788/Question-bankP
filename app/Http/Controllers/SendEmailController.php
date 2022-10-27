<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendEmail;
use Mail;
use Pdf;

class SendEmailController extends Controller
{
    public function sendMail(Request $request)
    {

            $id=$request->id;

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

        $result = ['data'=>$data,'userdata'=>$userdata];

        $pdf =  Pdf::loadView('PDF.viewPdf',['data'=>$data,'userdata'=>$userdata]);
        $data['subject'] =   $subject=$request->subject;
        Mail::send('emails.viewEmail',['data'=>$data,'userdata'=>$userdata,'msg'=>$request->message,'img'=>$request->img],function($message)use($pdf,$request) {
            $message->from('abc@yopmail.com', env('App_NAME'));
            $message->to('abc@yopmail.com');
            $message ->subject($request->subject);
            $message->attachData($pdf->output(),'Question Bank.pdf');
        });

        DB::table('userquizzes')->where('id', '=', $id)->update(['email_flag' => 1]);
        return back()->with('success','Mail sent successfully!');
    }

     public function showDataOnMailBox(Request $request)
     {

        try{
            $details = DB::table('userquizzes as uq')
            ->join('blocks as b','b.id','=','uq.block_id')
            ->join('users as u','u.id','=','uq.users_id')
            ->where([
                ['uq.id', $request->id],
            ])
            ->select('u.name','b.block_name','u.email','uq.id')
            ->get();
            return response()->json(['status'=>200,'data'=>$details]);
        }
        catch(\Exception $error){
            return $error->getMessage();
        }
     }
}
