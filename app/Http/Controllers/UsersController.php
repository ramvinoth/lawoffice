<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $org_id = Auth::user()->org_id;
        $user = User::where('org_id', '=', $org_id)->get();
        return response()->json($user);
    }

    public function edit()
    {
        return view('profiles.edit')->with('info', Auth::user()->profile);
    }

    public function update(Request $r)
    {

        $this->validate($r, [
            'location' => 'required',
            'about' => 'required|max:255'
        ]);

        Auth::user()->profile()->update([
            'location' => $r->location,
            'about' => $r->about
        ]);

        if($r->hasFile('avatar'))
        {
            Auth::user()->update([
                'avatar' => $r->avatar->store('public/avatars')
            ]);
        }

        Session::flash('success', 'Profile updated.');
        return redirect()->back();

    }





}
