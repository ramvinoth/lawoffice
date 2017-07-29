<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Util\CommonUtil;
use DateTime;
use Auth;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        //
        ///$caseTrait = new CaseListTrait();
        return response()
            ->json([
                'model' => CaseList::filterPaginateOrder()
            ]);
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
     * @param  \App\Case  $case
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Audit::where([['act_id','=',$id]])->get();
        return response()->json([
            'model' => $data
            ]);
    }
    
    public function addToAudit($act_id, $act_type, $act_by, $act_module)
	{
        $act_time = (new DateTime())->getTimestamp().'000';
        $org_id = Auth::user()->org_id;
        $audit_arr = array(['org_id' => $org_id,'act_id' => $act_id, 'act_type' => $act_type, 'act_by' => $act_by, 'act_module' => $act_module, 'act_time' => $act_time]);
        
        $audit = Audit::insert($audit_arr);
    }
    public function getCaseActivities(Request $request){
        $id = $request->id;
        $data = Audit::where([['act_id','=',$id]])->get();
        $act_obj = $this->getActivityJSONObject($data);
        return response()->json($act_obj);
    }
    
    public function getAllActivities(Request $request){
        $data = Audit::get();
        $act_obj = $this->getActivityJSONObject($data);
        return response()->json($act_obj);
    }
    
    public function getActivityJSONObject($activities){
        $commonUtil = new CommonUtil();
        $act_obj = [];
        foreach($activities as $activity){
            $act_time = $activity['act_time'];
            $act_date = $activity['act_date'] = $commonUtil->convertLongToDate($act_time,'d-m-Y');
            
            $user = User::find($activity['act_by']);
            if($activity['act_type'] == 'Add'){
                $activity['act_title'] = $user->name.' added the '.$activity['act_module'];
            }else if($activity['act_type'] == 'Update'){
                $activity['act_title'] = $user->name.' has updated the '.$activity['act_module'];
            }
            $activity_arr = array();
            array_push($activity_arr, $activity);
            if (isset($act_obj[$act_date])){
                array_push($act_obj[$act_date], $activity);
            }else{
                $act_obj[$act_date] = $activity_arr;
            }
        }
        return $act_obj;
    }
}