<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Auth;
use Session;
use App\Models\Hearing;
use Illuminate\Http\Request;
use App\Util\CommonUtil;

class HearingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Hearing::get();
        return response()->json($data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $event = Hearing::initialize();
        return response()
            ->json([
                'form' => $event,
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
        $hearing_array = $request->all();
        
        $hearing = Hearing::create($hearing_array);
        
        return response()->json([
            'saved' => true,
            'hearing' => $hearing,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Hearing::where([['id','=',$id]])->get();
        return response()->json([
            'model' => $data
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $hearing = Hearing::findOrFail($id);

        return response()
            ->json([
                'form' => $hearing,
                'option' => []
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hearing $hearing)
    {
        //
        $hearing_array = $request->all();
        $hearing_array['updated_at'] = (new DateTime())->getTimeStamp()."000";
        $status = $hearing->update($hearing_array);
        Session::flash('success', 'Hearing updated.');
        return response()
            ->json([
                'updated' => $status
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hearing  $hearing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hearing $hearing)
    {
        //
        $status = $hearing->delete();
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    
    public function getHearings(Request $request)
    {
        $id = $request->id;
        $data = Hearing::where([['case_id','=',$id]])->get();
        $commonUtil = new CommonUtil();
        foreach($data as $key => $dataObj){
            $data[$key]['date'] = $commonUtil->convertLongToDate($data[$key]['date'], 'd-m-Y');
        }
        return response()->json($data);
    }
    
    public function deleteHearings($id){
        $status = Hearing::whereId($id)->delete();
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    /*
    public function showCaseHearings(Request $request)
    {
        $id = $request->id;
        $data = Hearing::where([['case_id','=',$id]])->get();
        return response()->json($data);
    }
    */
    public function getHearingsList(Request $request)
    {
        $stDate = $request->sdate;
        $sdate = new DateTime('now');
        $edate = new DateTime('now');
        if($stDate != 'undefined' && $stDate != ''){
            $sdate = new DateTime($stDate);
            $edate = clone $sdate;
        }
        
        // First day of this month
        $sdate = $sdate->modify('first day of this month');
        $edate = $edate->modify('last day of this month');
        
        $isMonthView = true;
        $data = $this->getHearingsArr($sdate, $edate, $isMonthView);
        
        return response()->json($data);
        
    }
    
    public function getHearingsArr($sdate, $edate, $isMonthView){
        date_modify($sdate,'-10 day');
        date_modify($edate,'+10 day');
        $sd = $sdate->getTimestamp()."000";
        $ed = $edate->getTimestamp()."000";
        
        $query = Hearing::select('diary.id','diary.case_no as title','diary.posted as start', 'diary.case_id');
        
        if($isMonthView){
            $query->where([
                ['diary.posted','>=',$sd],
                ['diary.posted','<=',$ed]
            ]);
        }else{
            $query->where('EVENTS.start','>=',$sd)->orWhere('EVENTS.end','<',$ed);
        }
        
        $data = $query->get();
        $commonUtil = new CommonUtil();
        foreach ($data as $key => $event){
            $data[$key]['start'] = $commonUtil->convertLongToDate($data[$key]['start'], 'Y-m-d');
            $data[$key]['end'] = $data[$key]['start'];
            $data[$key]['id'] = $data[$key]['case_id'];
            $data[$key]['type'] = 'hearings';
            $data[$key]['borderColor'] = '#00a65a';
            $data[$key]['name'] = 'Hearing';
            $data[$key]['backgroundColor'] = '#00a65a';
        }
        return $data;
    }
}
?>