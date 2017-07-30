<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        return Company::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);
    }
}
