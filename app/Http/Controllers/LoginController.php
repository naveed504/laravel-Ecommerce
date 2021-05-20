<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

use Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)

    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials=$request->only('email','password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect()->back()->with('alert-dangerr', 'Oppes! You have entered invalid credentials');

    }
    public function logout()
    {
        Auth::logout();
        Alert::success('Success', 'User Loged Out ');
        return redirect()->back();

    }

}
