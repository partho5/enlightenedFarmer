<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherData;
use Illuminate\Support\Facades\DB;
use SoapClient;

use App\MyClasses\Library;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    
    public function Show_AddWeatherDataPage(){
        $dayAhedToForecast=14;
        
        $myLibrary=new Library();
        $allUpozila= $myLibrary->getAllUpozila();
        
        $weatherData=array();
        
        foreach($allUpozila as $nthUpozila){
            /* check if this upozila exist, if not, insert a row with this upozila */
            $retrievedData = WeatherData::where('upozila', $nthUpozila)->get();

            $today = \Carbon\Carbon::today();
            $today = \Carbon\Carbon::parse($today->toDateString());

            if (!count($retrievedData)) {
                //if !exist
                $customRow = [
                    'upozila' => $nthUpozila,
                    'date' => $today,
                    'short_description' => "",
                    'long_description' => "",
                    'source' => ""
                ];
                //insert it
                WeatherData::create($customRow);
            }
            /* check if this upozila exist, if not, insert a row with this upozila */



            $maxDate = WeatherData::select('date')
                            ->where('upozila', $nthUpozila)
                            ->orderBy('date', 'desc')->first();
            $maxDate = \Carbon\Carbon::parse($maxDate->date);


            $diff = $maxDate->diffInDays($today->copy()->addDays($dayAhedToForecast));

            for ($i = 0; $i < $diff; $i++) {
                $d = $maxDate->addDay(1);
                $customRow = [
                    'upozila' => $nthUpozila,
                    'date' => $d,
                    'short_description' => "",
                    'long_description' => "",
                    'source' => ""
                ];
                WeatherData::create($customRow);
                //echo $d."<br>";
            }

            $tmpQuery= WeatherData::all();
            $skipN= count($tmpQuery) - ($dayAhedToForecast +2 );
            $singleRegionData = WeatherData::where('upozila', $nthUpozila)
                    ->skip($skipN)->take(16)->get();
            array_push($weatherData, $singleRegionData);
        }
        
        return view('add_weather_data', ['weatherData'=>$weatherData, 'today'=>$today->toDateString()]);
    }
    
    public function sendTestSms(Request $request){
        $mobile=$request->mobile;
        $date=$request->date;
        
        $weatherMsg= WeatherData::select('short_description')->where('date', $date)->get();
        $weatherMsg=$weatherMsg[0]->short_description;
        
        //mail("partho8181bd@gmail.com", "Weather Forecast", $weatherMsg);
        
        try {
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'userName' => "017xxxxxxxx",
                'userPassword' => "123456",
                'mobileNumber' => $mobile,
                'smsText' => $weatherMsg,
                'type' => "TEXT",
                'maskName' => "DemoMask", 'campaignName' => ""
            );
            $value = $soapClient->__call("OneToOne", array($paramArray));
            //print_r($value);
            echo "Message sent to $mobile<br><a href='/admin/test/sms'>Send Another</a>";
        } catch (Exception $exc) {
            //echo $exc;
            echo "Network problem ! Try agin";
        }
    }

    
    public function show_sendSmsPage(){
        $daysToShowInDropDown=14;
        
        $myLibrary=new Library();
        $allUpozila=$myLibrary->getAllUpozila();
        
        $today=\Carbon\Carbon::today();        
        $dates=array();
        for($i=0; $i <= $daysToShowInDropDown;$i++){
            $today= $today->toDateString();
            array_push($dates, $today);
            
            //$today is now string, so again parse into date object
            $today= \Carbon\Carbon::parse($today);
            
            $today->addDay(1); //today is no longer 'Today', it points 1 day ahead, 2 days ahead ......and so on
        }
        
        
        return view('send_sms', ['allUpozila'=>$allUpozila, 'datesForDropdown'=>$dates]);
    }
    
    public function sendSmsToFarmersDatewise(Request $request){
        $upozila=$request->upozila;
        $dateToSend=$request->dateToSend;
        
        $myLibrary=new Library();
        $mobileNums=$myLibrary->getMobileNumsOfRegion($upozila);
        array_push($mobileNums, "01781603405");
        
        $weatherMsg=$myLibrary->getWeatherMsgOfDate($dateToSend);
        
        try {
            foreach ($mobileNums as $phone) {
                //$phone = $phone['phone']; //'phone' key is no longer required
                //echo $phone.'--';
                try {
                    $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
                    $paramArray = array(
                        'userName' => "017xxxxxxxx",
                        'userPassword' => "123456",
                        'mobileNumber' => $phone,
                        'smsText' => $weatherMsg,
                        'type' => "TEXT",
                        'maskName' => "DemoMask", 'campaignName' => ""
                    );
                    $value = $soapClient->__call("OneToOne", array($paramArray));
                    //print_r($value);
                } catch (Exception $exc) {
                    echo "Network problem ! Try agin";
                }
            }
            echo "sent";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

        public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $longDescription=$request->longDescription;
        $shortDescription=$request->shortDescription;
        $source=$request->source;
        
        DB::table('weather_data')
                ->where('id', $id)
                ->update([
                    'short_description' => $shortDescription,
                    'long_description' => $longDescription,
                    'source' => $source
        ]);
        echo "saved";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
