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
        $data = \App\CaseList::where([['cases.id','=',$id]])->join('misc_sr', 'cases.id', '=', 'misc_sr.cid')->join('petition','cases.id','=','petition.cid')->get();
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
    public function edit(CaseList $caselist)
    {
        //
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
    }
}
