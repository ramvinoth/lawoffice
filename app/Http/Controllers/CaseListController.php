<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\CaseList;
use App\Models\Petition;
use App\Models\ConnectedCase;
use App\Models\Documents;
use Illuminate\Http\Request;
use Auth;
use File;

class CaseListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()
            ->json([
                'model' => CaseList::filterPaginateOrder()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()
            ->json([
                'form' => CaseList::initialize(),
                'option' => []
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
        /*$this->validate($request, [
            'company' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'files' => 'max:255',
        ]);
        */
        $case_array = $request->all();
        
        $miscpet_arr = json_decode($case_array['misc_pet'], true);
        $case_array['other'] = $case_array['other'];
        if($case_array['against'] !== ''){
            $case_array['against'] = $case_array['against'];   
        }
        if($case_array['against1'] !== ''){
            $case_array['against1'] = $case_array['against1'];   
        }
        unset($case_array['misc_sr']);
        unset($case_array['connected']);
        unset($case_array['misc_pet']);
        unset($case_array['files']);
        
        $case_array['created_at'] = (new DateTime())->getTimestamp()."000";
        $case_array['updated_at'] = (new DateTime())->getTimestamp()."000";

        $court_case = CaseList::create($case_array);
        //Save Misc Petition
        foreach ($miscpet_arr as $key => $misc_pet){
            $miscpet_arr[$key]['cid'] = $court_case['id'];
            $miscpet_arr[$key]['sno'] = $court_case['sno'];
            $miscpet_arr[$key]['org_id'] = $court_case['org_id'];
        }
        $petition = Petition::insert($miscpet_arr);    
        
        //Save Attachment
        if($request->hasFile('files'))
        {
            foreach ($request->file('files') as $key => $file){
                $file_path = $file->store('public/uploads/case_files');
                $att_arr[$key]['case_id'] = $court_case['id'];
                $att_arr[$key]['path'] = $file_path;
                $att_arr[$key]['name'] = $file->getClientOriginalName();
                $att_arr[$key]['type'] = $file->getClientOriginalExtension();
                $att_arr[$key]['org_id'] = $court_case['org_id'];
                $att_arr[$key]['result'] = Documents::insert($att_arr);
            }
        }
        
        $act_id = $court_case['id'];
        $act_type = 'Add';
        $act_by = Auth::user()->id;
        $act_module = 'caselist';
        $auditController = new AuditController();
        $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        
        return response()
            ->json([
                'saved' => true,
                'court_case' => $court_case,
                'misc_pet' => $misc_pet,
            ]);
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
        $data = CaseList::select('cases.*', 'COURT_TYPE.court_type')->where([['cases.id','=',$id]])->leftjoin('misc_sr', 'cases.id', '=', 'misc_sr.cid')->leftjoin('petition','cases.id','=','petition.cid')->leftjoin('COURT_TYPE','cases.court_type_id','=','COURT_TYPE.id')->get();
        $data= $data[0];
        //$data['court_type'] = $this->getCourtType($data['court_type']);
        
        $data['other'] = json_decode($data['other'], true);
        $data['against'] = json_decode($data['against'], true);
        $data['against1'] = json_decode($data['against1'], true);
        
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Case  $case
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $caselist = CaseList::select('cases.*')->where([['cases.id','=',$id]])->leftjoin('misc_sr as misc_sr', 'cases.id', '=', 'misc_sr.cid')->get();
        
        $misc_pet = Petition::where([['cid','=',$id]])->get();
        
        $misc_pet_table = ["misc_pet" => array(['mpno' => '', 'mpyear' => '', 'mpdate' => '', 'mpprayer' => '', 'mpdisposal' => '', 'mpreturn' => '', 'mprepresent' => ''])];
        
        $caselist = $caselist[0];
        
        if(isset($caselist['other']) && $caselist['other'] !== '' && $caselist['other'] !== '-'){
            $other_counsel = json_decode($caselist['other']);
            if($other_counsel == null){
                $other_arr = explode("-",$caselist['other']);
                //print_r ($other_arr);
                $other_counsel = array(['other_counsel'=>$other_arr[0], 'contact'=>$other_arr[1]]);
            }
            $caselist['other'] = $other_counsel;
        }else{
            $caselist['other'] = array(['other_counsel'=>'', 'contact'=>'']);
        }
        if($caselist['court_type_id'] == 2){
            if(isset($caselist['against']) && $caselist['against'] !== '' && $caselist['against'] !== '-'){
                $against  = json_decode($caselist['against']);
                if($against == null){
                    $against_arr = explode("-",$caselist['against']);
                    $against = ['lno'=> $against_arr[0], 'lcourt'=> $against_arr[1], 'lplace'=> $against_arr[2], 'lorder'=> $against_arr[3]];
                }
                $caselist['against'] = $against;
            }else{
                $caselist['against'] = ['lno'=> '', 'lcourt'=> '', 'lplace'=> '', 'lorder'=> ''];
            }
            if(isset($caselist['against1']) && $caselist['against1'] !== '' && $caselist['against1'] !== '-'){
                $against1 = json_decode($caselist['against1']);
                if($against1 == null){
                    $against1_arr = explode("-",$caselist['against1']);
                    $against1 = ['lno'=> $against1_arr[0], 'lcourt'=> $against1_arr[1], 'lplace'=> $against1_arr[2], 'lorder'=> $against1_arr[3]];
                }
                $caselist['against1'] = $against1;
            }else{
                $caselist['against1'] = ['lno'=> '', 'lcourt'=> '', 'lplace'=> '', 'lorder'=> ''];
            }
        }
        $caselist['misc_pet'] = $misc_pet;
        
        return response()
            ->json([
                'form' => $caselist,
                'option' => []
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Case  $case
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseList $caselist)
    {
        //
        $case_array = $request->all();
        $case_id = $request->id;
        $miscpet_arr = json_decode($request['misc_pet']);
        $case_array['other'] = $case_array['other'];
        $case_array['against'] = $case_array['against'];
        $case_array['against1'] = $case_array['against1'];
        unset($case_array['misc_sr']);
        unset($case_array['connected']);
        unset($case_array['misc_pet']);
        
        $case_array['updated_at'] = (new DateTime())->getTimestamp()."000";
        
        $court_case = CaseList::find($case_id)->update($case_array);
        foreach ($miscpet_arr as $key => $misc_pet){
            $pet_id = $misc_pet->id;
            $misc_pet->sno = $case_array['sno'];
            unset($misc_pet->id);
            unset($misc_pet->cid);
            $petition = Petition::where([['cid','=',$case_id],['id','=',$pet_id]])->update((array)$misc_pet); 
        }     
        //Save Attachment
        //print_r($case_array);
        if($request->hasFile('files'))
        {
            print_r("1<br>\n");
            foreach ($request->file('files') as $key => $file){
                print_r("2<br>\n");
                $file_path = $file->store('public/uploads/case_files');
                $att_arr[$key]['case_id'] = $court_case['id'];
                $att_arr[$key]['path'] = $file_path;
                $att_arr[$key]['name'] = $file->getClientOriginalName();
                $att_arr[$key]['type'] = $file->getClientOriginalExtension();
                $att_arr[$key]['org_id'] = $court_case['org_id'];
                $att_arr[$key]['result'] = Documents::insert($att_arr);
                print_r("2<br>\n : ".$att_arr[$key]['result']);
            }
        }
        
        $act_id = $case_array['id'];
        $act_type = 'Update';
        $act_by = Auth::user()->id;
        $act_module = 'caselist';
        $auditController = new AuditController();
        $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        
        return response()
            ->json([
                'saved' => true,
            ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Case  $case
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseList $caselist)
    {
        //
        
        Petition::where('cid','=',$caselist->id)->delete();
        ConnectedCase::where('cid','=',$caselist->id)->delete();
        
        $caselist->delete();
        
        $act_id = $caselist->id;
        $act_type = 'Delete';
        $act_by = Auth::user()->id;
        $act_module = 'caselist';
        $auditController = new AuditController();
        $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        
        return response()
            ->json([
                'deleted' => true
            ]);
    }
    public function getCourtType($courtId){
        $courts = ['1'=>'Supreme Court',
                        '2'=>'High Court',
                        '3'=>'District Court',
                        '4'=>'Consumer Court',
                        '5'=>'Tribunal Court'
                       ];
        return $courts[$courtId];
    }
    
    public function getCasePetition(Request $request){
        $case_id = $request->id;
        $petition = Petition::where('cid','=',$case_id)->get();
        return response()->json($petition);
    }
    
    public function updateCasePetition(Request $request){
        $petition_array = $request->all();
        $status = Petition::whereId($request->id)->update($petition_array);
        
        if($status){
            $act_id = $petition_array['id'];
            $act_type = 'Update';
            $act_by = Auth::user()->id;
            $act_module = 'petition';
            $auditController = new AuditController();
            $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        }
        return response()
            ->json([
                'updated' => $status
            ]);
    }
    
    public function saveCasePetition(Request $request){
        $petition_array = $request->all();
        $petition_array['created_at'] = (new DateTime())->getTimestamp();
        
        $petition = Petition::create($petition_array);
        
        $act_id = $petition_array['cid'];
        $act_type = 'Add';
        $act_by = Auth::user()->id;
        $act_module = 'petition';
        $auditController = new AuditController();
        $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        
        return response()
            ->json([
                'saved' => $petition,
                'petition' => $petition_array,
            ]);
    }
    public function saveConnectedCase(Request $request){
        $con_case_array = $request->all();
        $con_case = ConnectedCase::create($con_case_array);
        
        $act_id = $con_case['id'];
        $act_type = 'Add';
        $act_by = Auth::user()->id;
        $act_module = 'connected case';
        $auditController = new AuditController();
        $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        
        return response()
            ->json([
                'saved' => true,
                'petition' => $con_case_array,
            ]);
    }
    public function deleteCasePetition($id){
        $status = Petition::where('id','=',$id)->delete();
        if($status){
            $act_id = $id;
            $act_type = 'Delete';
            $act_by = Auth::user()->id;
            $act_module = 'connected case';
            $auditController = new AuditController();
            $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        }
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    public function deleteConnectedCase($id){
        $status = ConnectedCase::where('id','=',$id)->delete();
        
        $act_id = $id;
        $act_type = 'Delete';
        $act_by = Auth::user()->id;
        $act_module = 'connected case';
        $auditController = new AuditController();
        $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    
    public function getConnectedCase(Request $request){
        $case_id = $request->id;
        $connected = ConnectedCase::where('cid','=',$case_id)->get();
        return response()->json($connected);
    }
    
    public function updateConnectedCase(Request $request){
        $connected_array = $request->all();
        $status = ConnectedCase::whereId($request->id)->update($connected_array);
        
        if($status){
            $act_id = $connected_array['id'];
            $act_type = 'Update';
            $act_by = Auth::user()->id;
            $act_module = 'connected case';
            $auditController = new AuditController();
            $auditController->addToAudit($act_id, $act_type, $act_by, $act_module);
        }
        
        return response()
            ->json([
                'updated' => $status
            ]);
    }
    
    public function addCaseDocument(Request $request){
        //Save Attachment
        $att_arr = [];
        if($request->hasFile('files'))
        {
            foreach ($request->file('files') as $key => $file){
                $file_path = $file->store('public/uploads/case_files');
                $att_arr[$key]['case_id'] = $request->case_id;
                $att_arr[$key]['path'] = $file_path;
                $att_arr[$key]['name'] = $file->getClientOriginalName();
                $att_arr[$key]['type'] = $file->getClientOriginalExtension();
                $att_arr[$key]['org_id'] = Auth::user()->org_id;
                $att_arr[$key]['status'] = Documents::insert($att_arr);
            }
        }
        
        return response()->json($att_arr);
    }
    
    /*
        For Dashboard
    */
    public function getLatestCases(){
        $data = CaseList::select('id', 'case_no', 'case_title', 'petitioner', 'status')->orderBy('id', 'desc')->limit(10)->get();
        return $data;
    }
    
    public function getAllCaseCount(){
        $data = CaseList::count();
        return $data;
    }
    
    public function getAllPendingCaseCount(){
        $data = CaseList::where('status','=','Pending')->count();
        return $data;
    }
    
    public function getCaseStatusCount(){
        $data = CaseList::selectRaw('status, count(*) as count')->groupBy('status')->get();
        return $data;
    }
}
