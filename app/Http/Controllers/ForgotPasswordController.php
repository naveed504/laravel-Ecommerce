<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use Carbon\Carbon;
use App\Models\User;
use DB;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        return view('wayshop.users.forgot_pass');
    }
    public function recoverpassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(60);
        DB::table('password_resets')->insert(
            ['email'=>$request->email, 'token'=>$token , 'created_at'=>Carbon::now()]
        );
        Mail::send('wayshop.users.verify',['token' => $token], function($message) use ($request) {
            $message->from($request->email);
            $message->to('codingdriver15@gmail.com');
            $message->subject('Reset Password Notification');
         });

  return back()->with('alert-success', 'We have e-mailed your password reset link!');




    }
}
