<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use App\Models\UserCompanyMapping;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $org_id = Auth::user()->org_id;
        $user = User::where('org_id', '=', $org_id)->get();
        return response()->json($user);
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
                'form' => User::initialize(),
                'option' => []
            ]);
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
    public function getAuthUserData(){
        $id = Auth::user()->id;
        $org_id = Auth::user()->org_id;
        //return UserCompanyMapping::with('user')->where('UserCompanyMapping.user_id','=',$id)->get();
        //return User::whereId($id)->leftJoin('UserCompanyMapping','users.org_id','=','UserCompanyMapping.org_id')->where('users.org_id','=',$org_id)->get();
        return User::find($id)->with('role')->where([['users.id','=',$id],['org_id','=',$org_id]])->first();
    }

}
