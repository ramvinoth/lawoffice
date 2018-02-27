<?php
namespace App\Traits;
use DateTime;
use DateTimeZone;
use Auth;
trait CommonTrait{
    
    public function convertDateToLong($date){
        $date = str_replace('/', '-', $date);
        $sd= new DateTime(date("Y-m-d H:i:s", strtotime($date)));
        //$sd->setTimeZone(new DateTimeZone('Asia/Calcutta'));
        return $sd->getTimeStamp()."000";
    }
    
    public function convertLongToDate($date, $format, $timezone){
        $date = new DateTime(date('d-m-Y H:i:s', $date/1000));
        $date->setTimeZone(new DateTimeZone($timezone));
        if($format == null || $format == ''){
            $format = 'Y-m-d';
        }
        return $date->format($format);
    }
    public static function getDatetimeNow() {
        $tz_object = new DateTimeZone('Asia/Calcutta');
        //date_default_timezone_set('Brazil/East');

        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('d\-m\-Y\ h:i:s');
        //return $datetime->getTimestamp()."000";
    }
    public function getCurrentLongTime(){
        return (new DateTime())->getTimestamp()."000";
    }
}   
?>