<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPasswordController extends Controller
{
    public function resetpassword($token)
    {
        return view('wayshop.users.resetpassword',['token'=>$token]);

    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);
        $updatePassword = DB::table('password_resets')
        ->where(['email' => $request->email, 'token' => $request->token])
        ->first();

if(!$updatePassword)
return back()->withInput()->with('error', 'Invalid token!');

$user = User::where('email', $request->email)
  ->update(['password' => Hash::make($request->password)]);

DB::table('password_resets')->where(['email'=> $request->email])->delete();
Alert::success('Success', 'Password Changed Successfully');

return redirect('register')->with('message', 'Your password has been changed!');


    }
}
