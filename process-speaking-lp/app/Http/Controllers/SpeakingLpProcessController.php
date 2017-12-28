<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SpeakingLpProcess;
use Mail;

class SpeakingLpProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $order = SpeakingLpProcess::all();
       return view('home', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $company = $request->input('company');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $a = new SpeakingLpProcess;
        $a->name  = $name;
        $a->company = $company;
        $a->phone = $phone;
        $a->email = $email;

        $a->save();

        static::notify_sales($a);
        static::send_thankyou_email($a->email);
        // static::notify_hubspots($a);
        return redirect('http://google.com');
    }


    public function notify_sales($user)
    {
      $email = $user->email;
      $data = array('name' => $user->name, 'company' => $user->company, 'email'=> $user->email, 'phone'=> $user->phone);
       Mail::send('emails.sales',$data, function ($message) use ($email)
       {
        $message->from('auto-notif@knowledgecoop.com', 'Form Notification');
       $message->to('ccampbell@sapphirebd.com'); //Send to Sales
		   $subject = "Speaking Request Submission";
		   $message->subject($subject);
       });
    }


    public function send_thankyou_email($userEmail)
    {
      $data = array();
       Mail::send('emails.thankyou',$data, function ($message) use ($userEmail)
       {
        $message->from('auto-notif@knowledgecoop.com', 'The Knowledge Coop');
       $message->to($userEmail); //Send to Sales
		   $subject = "Thank you for reaching out. :) ";
		   $message->subject($subject);
       });
    }


}
