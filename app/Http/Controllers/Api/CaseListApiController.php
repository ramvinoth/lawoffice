<?php

namespace App\Http\Controllers\API;
    
use Illuminate\Http\Request;
use App\Http\Contollers\Controller;
use App\CaseList;

class CaseListApiController extends Controller{
    
    public function getCaseList(Request $request){
        $userId= $request->user()->id;
        $user = User::where('id', $userId)->first();
        $caselist = CaseList::select('court','case_type')->orderBy('id')->paginate();
    }
}
?>