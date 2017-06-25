<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserApiController extends Controller{
    
    public function postSidebarToggle(Request $request){
        $userId= $request->user()->id;
        $user = User::where('id', $userId)->first();
        
    }
    
}
    
?>