<?php

namespace App\MyClasses;

class Library {
    public function getAllUpozila(){
        //$upo=array("Dinajpur", "Kaharole", "Birganj");
        $upo= \App\Farmers::select('upozilla')->distinct()->get();
        $retVal=array();
        foreach ($upo as $val){
            array_push($retVal, $val['upozilla']);
        }
        return $retVal;
    }
    
    public function getMobileNumsOfRegion($upozila){
        $nums= \App\Farmers::select('phone')
                ->where('upozilla', $upozila)
                ->get();
        
        $retVal=array();
        foreach ($nums as $num){
            array_push($retVal, $num['phone']);
        }
        
        return $retVal;
    }
    
    
    public function getWeatherMsgOfDate($date){
        $msg= \App\WeatherData::select('short_description')
                ->where('date', $date)
                ->get();
        
        return $msg[0]['short_description'];
    }
}
