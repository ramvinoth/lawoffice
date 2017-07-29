<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Auth;
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
        $date = new DateTime();
        $hearing_array['created_at'] = $date->getTimeStamp();
        $hearing_array['updated_at'] = $date->getTimeStamp();
        $eventController = new EventController();
        $hearing_array['date'] = $eventController->convertDateToLong($hearing_array['date']);
        
        $hearing = Hearing::insert($hearing_array);
        
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
        $status = $hearing->update($hearing_array);
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
        $dataObj = Hearing::where([['case_id','=',$id]])->get();
        $commonUtil = new CommonUtil();
        $jsonObj = [];
        foreach($dataObj as $data){
            $data['date'] = $commonUtil->convertLongToDate($data['date'], 'd-m-Y');
            $jsonObj = $data;
        }
        return response()->json([$jsonObj]);
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
}
?>