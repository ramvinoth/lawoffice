<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        return Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);
    }
}
