<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use App\User;

class UserController extends Controller
{
    // Authentication Method
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function userSettingsInfoUpdate(Request $request)
    {
      $request->validate([
      'name' => 'required|string|max:20',
      'nickname' => 'required|string|max:10',
      'username' => 'required|string|max:25',
      'email' => 'required|string|email',
      'nidn' => 'required|string|max:17',
      'brn' => 'required|string|max:17',
      'mobile' => 'required|string|max:14',
      'gender' => 'required|string|max:1',
      'dob' => 'required|string',
      'address' => 'required|string',
      ]);
      //Validation Part End

      User::find(Auth::id())->update([
        'name' => $request->name,
        'nickname' => $request->nickname,
        'username' => $request->username,
        'email' => $request->email,
        'nidn' => $request->nidn,
        'brn' => $request->brn,
        'mobile' => $request->mobile,
        'gender' => $request->gender,
        'dob' => $request->dob,
        'address' => $request->address,
      ]);
      return back()->with('status', 'General Informations Updated Successfully!');
    }

    public function userProfile($userIdentifier)
    {
      $userInfo = User::where('username', $userIdentifier)->orwhere('id', $userIdentifier)->firstOrFail();
      return view('common.profile.index', compact('userInfo'));
    }
    public function userSettings($userIdentifier)
    {
      $userInfo = User::where('username', $userIdentifier)->orwhere('id', $userIdentifier)->firstOrFail();
      return view('common.profile.settings', compact('userInfo'));
    }
    // User Password Update
    public function userSettingsPasswordUpdate(Request $request)
    {
      if (Hash::check($request->current_password, Auth::user()->password)) {
        $request->validate([
         'new_password' => 'required|string|min:8|confirmed',
        ]);
        User::findOrFail(Auth::id())->update([
          'password' => Hash::make($request->new_password)
        ]);
        return back()->with('status', 'Password Updated Successfully!');
      }else{
        return back()->with('status', 'Current Password Not Matched!');
        // return redirect('/')->with(Auth::logout());
      }
    }
}
