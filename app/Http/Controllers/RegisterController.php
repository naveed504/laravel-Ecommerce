<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class RegisterController extends Controller
{
    public function register()
    {
        return view('wayshop.users.login_register');
    }
    public function userRegister(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required_with:password_confirmation|same:password_confirmation|string|min:6',
          'password_confirmation' => 'min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return redirect()->back()->with('alert-success', 'Your Account Has Been Registered , Please Login');
    }
}
