<?php

namespace App\Http\Controllers;

use App\CaseList;
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
        
        $misc_pet = $case_array['misc_pet'];
        $otherCounsel = $case_array['other'];
        $case_array['other'] = json_encode($otherCounsel);
        unset($case_array['misc_sr']);
        unset($case_array['connected']);
        unset($case_array['misc_pet']);
        
        $court_case = CaseList::create($case_array);

        return response()
            ->json([
                'saved' => true,
                'all' => $case_array,
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
        $data = \App\CaseList::select('cases.*')->where([['cases.id','=',$id]])->join('misc_sr', 'cases.id', '=', 'misc_sr.cid')->join('petition','cases.id','=','petition.cid')->get();
        
        $data= $data[0];
        
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
        $caselist = \App\CaseList::select('cases.*')->where([['cases.id','=',$id]])->join('misc_sr as misc_sr', 'cases.id', '=', 'misc_sr.cid')->get();
        
        $misc_pet = \App\Petition::where([['cid','=',$id]])->get();
        
        $misc_pet_table = ["misc_pet" => array(['mpno' => '', 'mpyear' => '', 'mpdate' => '', 'mpprayer' => '', 'mpdisposal' => '', 'mpreturn' => '', 'mprepresent' => ''])];
        
        $caselist = $caselist[0];
        
        if(isset($caselist['other']) && $caselist['other'] !== '' && $caselist['other'] !== '-'){
            $caselist['other'] = json_decode($caselist['other']);
        }else{
            $caselist['other'] = array(['other_counsel'=>'', 'contact'=>'']);
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
        
        $caselist->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
