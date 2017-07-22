<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\CaseList;
use App\Models\Petition;
use App\Models\ConnectedCase;
use Illuminate\Http\Request;

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
            'address' => 'required'
        ]);
        */
        $case_array = $request->all();
        
        $miscpet_arr = $case_array['misc_pet'];
        $case_array['other'] = json_encode($case_array['other']);
        if($case_array['against'] !== ''){
            $case_array['against'] = json_encode($case_array['against']);   
        }else if($case_array['against1'] !== ''){
            $case_array['against1'] = json_encode($case_array['against1']);   
        }
        unset($case_array['misc_sr']);
        unset($case_array['connected']);
        unset($case_array['misc_pet']);
        
        $case_array['created_at'] = new DateTime();
        $case_array['updated_at'] = new DateTime();
        
        $court_case = CaseList::create($case_array);
        foreach ($miscpet_arr as $key => $misc_pet){
            $miscpet_arr[$key]['cid'] = $court_case['id'];
            $miscpet_arr[$key]['sno'] = $court_case['sno'];
        }
        $petition = Petition::insert($miscpet_arr);      
        
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
                $against_obj  = json_decode($caselist['against']);
                if($against_obj == null){
                    $against_arr = explode("-",$caselist['against']);
                    print_r ($caselist['against']);
                    $against = ['lno'=> $against_arr[0], 'lcourt'=> $against_arr[1], 'lplace'=> $against_arr[2], 'lorder'=> $against_arr[3]];
                    $caselist['against'] = $against;
                }
            }else{
                $caselist['against'] = ['lno'=> '', 'lcourt'=> '', 'lplace'=> '', 'lorder'=> ''];
            }
            if(isset($caselist['against1']) && $caselist['against1'] !== '' && $caselist['against1'] !== '-'){
                $against1_obj = json_decode($caselist['against1']);
                if($against1_obj == null){
                    $against1_arr = explode("-",$caselist['against1']);
                    $against1 = ['lno'=> $against1_arr[0], 'lcourt'=> $against1_arr[1], 'lplace'=> $against1_arr[2], 'lorder'=> $against1_arr[3]];
                    $caselist['against1'] = $against1;
                }
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
        
        $miscpet_arr = $case_array['misc_pet'];
            
        $case_array['other'] = json_encode($case_array['other']);
        $case_array['against'] = json_encode($case_array['against']);
        $case_array['against1'] = json_encode($case_array['against1']);
        unset($case_array['misc_sr']);
        unset($case_array['connected']);
        unset($case_array['misc_pet']);
        
        $case_array['updated_at'] = new DateTime();
        
        $court_case = $caselist->update($case_array);
        foreach ($miscpet_arr as $key => $misc_pet){
            $pet_id = $miscpet_arr[$key]['id'];
            $miscpet_arr[$key]['sno'] = $court_case['sno'];
            unset($misc_pet['id']);
            unset($misc_pet['cid']);
            $petition = Petition::where([['cid','=',$case_id],['id','=',$pet_id]])->update($misc_pet); 
        }     
        
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
        
        $caselist->join('petition','cases.id','petition.cid')->delete();

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
    
    public function saveCasePetition(Request $request){
        $petition_array = $request->all();
        $petition = Petition::insert($petition_array);
        return response()
            ->json([
                'saved' => $petition,
                'petition' => $petition_array,
            ]);
    }
    public function saveConnectedCase(Request $request){
        $con_case_array = $request->all();
        $status = ConnectedCase::insert($con_case_array);
        return response()
            ->json([
                'saved' => $status,
                'petition' => $con_case_array,
            ]);
    }
    public function deleteCasePetition($id){
        $status = Petition::where('id','=',$id)->delete();
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    public function deleteConnectedCase($id){
        $status = ConnectedCase::where('id','=',$id)->delete();
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
    
    public function getLatestCases(){
        //print_r (1);
        $data = CaseList::select('id', 'case_no', 'case_title', 'petitioner', 'status')->orderBy('id', 'desc')->limit(10)->get();
        return $data;
    }
    
    public function getAllCaseCount(){
        //print_r (1);
        $data = CaseList::count();
        return $data;
    }
    
    public function getAllPendingCaseCount(){
        //print_r (1);
        $data = CaseList::where('status','=','Pending')->count();
        return $data;
    }
}
