<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Livece;

class LiveceController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    #Take Inputs
      $class = $request->input('event');
      $email = $request->input('email_home');
      #Assign Inputs to attributes
      $a = new Livece;
      $a->class  = $class;
      $a->email = $email;
      #Try to save
      try {
        $a->save();
      } catch (\Exception $e) {
          \Bugsnag::notifyError('ErrorType', 'Issue Saving Form Data '.$e);
      }
      return "OK";
  }



  public function index()
  {
     $order = Livece::all();
     if (empty($order)) {
       $order = array();
     }
     return view('2f', compact('order'));
  }






}
