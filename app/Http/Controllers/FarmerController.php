<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    
    
    public function showRegForm(){
        return view('showRegForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\FarmerRegRequest $request)
    {
        \App\Farmers::create($request->all());
        
        $name=$request->name;
        $phone=$request->phone;
        
        try {
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'userName' => "01781603405",
                'userPassword' => "123456",
                'mobileNumber' => $phone,
                'smsText' => "আপনার মত একজন প্রযুক্তি সচেতন কৃষক কে পেয়ে আমারা আনন্দিত। "
                .$name.", অভিনন্দন আপনাকে। প্রতিদিনের অবহাওয়ার আপডেট আপনাকে SMS এ জানিয়ে দেয়া হবে।",
                'type' => "TEXT",
                'maskName' => "DemoMask", 'campaignName' => ""
            );
            $value = $soapClient->__call("OneToOne", array($paramArray));
            //print_r($value);
            //echo "Message sent to $phone<br><a href='/admin/test/sms'>Send Another</a>";
        } catch (Exception $exc) {
            //echo $exc;
            echo "Network problem ! Try agin";
        }

        
        return view('farmerRegsuccessPage', ['name'=>$name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    public function fetchAllFarmers(){
        $results= \App\Farmers::all();
        
        return view('showAllFarmers', ['allFarmers'=>$results]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
