<?php

namespace App\Support;

use Illuminate\Http\Request;

trait CaseListTrait {
    public function getDiaryEvents()
    {
        //
        $data = \App\Diary::select('cdate','case_no')->get();
        return response()->json([
                'title' => $data,
            ]);
    }
}