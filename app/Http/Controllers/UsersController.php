<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\User;
use App\Models\Profile;
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
    
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function store(Request $request)
    {
        $data = $request->all();
        $org_id = Auth::user()->org_id;
        $avatar = 'public/avatars/male.jpg';
        $user =  User::create([
            'org_id' => $org_id,
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => '1',
            'password' => bcrypt($data['password']),
            'slug' => str_slug($data['name']),
            'avatar' => $avatar
        ]);

        Profile::create(['user_id' => $user->id ]);
        return $user;
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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Case  $case
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $status = $user->delete();
        return response()
            ->json([
                'deleted' => true,
                'status' => $status
            ]);
    }
    
    public function getAuthUserData(){
        $id = Auth::user()->id;
        $org_id = Auth::user()->org_id;
        //return UserCompanyMapping::with('user')->where('UserCompanyMapping.user_id','=',$id)->get();
        //return User::whereId($id)->leftJoin('UserCompanyMapping','users.org_id','=','UserCompanyMapping.org_id')->where('users.org_id','=',$org_id)->get();
        return User::find($id)->with('role')->where([['users.id','=',$id],['org_id','=',$org_id]])->first();
    }

}
