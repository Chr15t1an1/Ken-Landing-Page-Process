<?php

namespace App\Http\Controllers;

use App\ceSelector;
use Illuminate\Http\Request;

class CeSelectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

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

      return $request;
      #Take Inputs
        $class = $request->input('cart');
        $email = $request->input('email');
        #Assign Inputs to attributes
        $a = new ceSelector;
        $a->class  = $class;
        $a->email = $email;
        #Try to save
        try {
          $a->save();
        } catch (\Exception $e) {
            \Bugsnag::notifyError('ErrorType', 'Issue Saving Form Data CE Selector '.$e);
        }
        return "OK";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ceSelector  $ceSelector
     * @return \Illuminate\Http\Response
     */
    // public function show(ceSelector $ceSelector)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ceSelector  $ceSelector
     * @return \Illuminate\Http\Response
     */
    // public function edit(ceSelector $ceSelector)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ceSelector  $ceSelector
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, ceSelector $ceSelector)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ceSelector  $ceSelector
     * @return \Illuminate\Http\Response
     */
    // public function destroy(ceSelector $ceSelector)
    // {
    //     //
    // }
}
