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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

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


    // public function notify_hubspot($userdata)
    // {
    //   $hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
    //     $ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
    //     $hs_context      = array(
    //                             'hutk' => $hubspotutk,
    //                             'ipAddress' => $ip_addr,
    //                             'pageUrl' => 'http://www.example.com/form-page',
    //                             'pageName' => 'Example Title'
    //                             );
    //     $hs_context_json = json_encode($hs_context);
    //
    //     //Need to populate these variable with values from the form.
    //     $str_post = "firstname=" . urlencode($firstname)
    //                 . "&lastname=" . urlencode($lastname)
    //                 . "&email=" . urlencode($email)
    //                 . "&phone=" . urlencode($phonenumber)
    //                 . "&company=" . urlencode($company)
    //                 . "&hs_context=" . urlencode($hs_context_json); //Leave this one be
    //
    //     //replace the values in this URL with your portal ID and your form GUID
    //     $endpoint = 'https://forms.hubspot.com/uploads/form/v2/{portalId}/{formGuid}';
    //
    //     $ch = @curl_init();
    //     @curl_setopt($ch, CURLOPT_POST, true);
    //     @curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
    //     @curl_setopt($ch, CURLOPT_URL, $endpoint);
    //     @curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //     'Content-Type: application/x-www-form-urlencoded'
    //     ));
    //     @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response    = @curl_exec($ch); //Log the response from HubSpot as needed.
    //     $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
    //     @curl_close($ch);
    //     echo $status_code . " " . $response;
    // }



    //
    // public function redirect_to_lp($id)
    // {
    //     //
    // }
    //



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
