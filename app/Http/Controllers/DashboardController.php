<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Support\CaseListTrait;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CaseListTrait;
    public function index(Request $request)
    {
        //
        ///$caseTrait = new CaseListTrait();
        $action = $request->action;
        $data = null;
        if($action == 'getlatestcases'){
            $caselist = new CaseListController();
            $data = $caselist->getLatestCases();
        }else if($action == 'getcount'){
            $caselist = new CaseListController();
            $event = new EventController();
            $hearings = new HearingsController();
            $data['all_cases'] = $caselist->getAllCaseCount();
            $data['all_pending'] = $caselist->getAllPendingCaseCount();
            $data['all_events'] = $event->getAllEventsCount();
            $data['tmrw_hearing'] = $hearings->getTomorrowsHearingCount();
        }else if($action == 'gettodaysevents'){
            $event = new EventController();
            $data = $event->getTodaysEvents();
        }else if($action == 'getcasestatus'){
            $caseController = new CaseListController(); 
            $data = $caseController->getCaseStatusCount();
        }else if($action == 'getupcominghearing'){
            $hearingsController = new HearingsController();
            $data = $hearingsController->getUpcomingHearing();
        }
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
        return response()
            ->json([
                'form' => Calendar::initialize(),
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
        $data = Calendar::where([['cases.id','=',$id]])->join('misc_sr', 'cases.id', '=', 'misc_sr.cid')->join('petition','cases.id','=','petition.cid')->get();
        return response()->json([
            'model' => $data
            ]);
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
        $calendar = Calendar::findOrFail($id);

        return response()
            ->json([
                'form' => $calendar,
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
    public function update(Request $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Case  $case
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        //
    }
}
