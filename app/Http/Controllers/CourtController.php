<?php

namespace App\Http\Controllers;

use App\Court;
use App\GeoLocations;
use App\CaseType;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function getdata(Request $request){
        $type = $request->type;
        if($type == "state"){
            $data = GeoLocations::select('id as value','name as text')->where([['location_type','=','STATE']])->get();
        }else if($type== "district"){
            $code = $request->code;
            $data = GeoLocations::select('id as value','name as text')->where([['location_type','=','DISTRICT'],['parent_id','=',$code]])->get();
        }else if($type== "court_type"){
            $code = $request->code;
            $data = Court::select('id as value','court_name as text')->where([['court_type','=',$code]])->get();
        }else if($type== "court"){
            $district_code = $request->district_code;
            $court_type = $request->court_type;
            
            if($court_type != 3 && $district_code ==''){
                $data = Court::select('id as value','court_name as text')->where([['court_type','=',$court_type]])->get();
            }else if($court_type == 3 && $district_code != ''){
                $data = Court::select('id as value','court_name as text')->where([['location_id','=',$district_code]])->get();
            }
        }else if($type== "case_type"){
            $code = $request->code;
            $court_type = $request->court_type;
            
            if($court_type != 3){
                   $data = CaseType::select('id as value','case_name as text')->where([['court_type','=',$court_type]])->get();
            }else{
                $data = CaseType::select('id as value','case_name as text')->where([['court_id','=','1']])->get();
            }
        }
        return response()->json($data);
    }  
}
?>