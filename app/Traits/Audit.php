<?php
namespace App\Traits;
use Auth;
trait Audit{
    
    public function addToAudit($act_id, $act_type, $act_by, $act_module)
	{
        $act_time = (new DateTime())->getTimestamp()+'000';
        $org_id = Auth::user()->org_id;
        $audit_arr = array(['org_id' => $org_id,'act_id' => $act_id, 'act_type' => $act_type, 'act_by' => $act_by, 'act_module' => $act_module]);
        
        $audit = Audit::insert($audit_arr);
    }
}    
?>