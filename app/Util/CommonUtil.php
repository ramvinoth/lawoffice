<?php
namespace App\Util;

use Illuminati\Http\Request;
use DateTime;
use DateTimeZone;
use Auth;

class CommonUtil{
    
    public function convertDateToLong($date){
        $date = str_replace('/', '-', $date);
        $sd= new DateTime(date("Y-m-d H:i:s", strtotime($date)));
        //  print_r (new DateTime($sd));
        return $sd->getTimeStamp()."000";
    }
    
    public function convertLongToDate($date, $format){
        $date = new DateTime(date('d-m-Y H:i:s', $date/1000));
        //$date->setTimeZone(new DateTimeZone('Asia/Calcutta'));
        if($format == null || $format == ''){
            $format = 'Y-m-d';
        }
        return $date->format($format);
    }
}