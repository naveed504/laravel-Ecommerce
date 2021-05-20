<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Auth;
use Hash;

class UserAccountController extends Controller
{
    public function account()
    {
        return view('wayshop.users.account');
    }
    public function changepassword()
    {
       return view('wayshop.users.change_password');
    }
    public function savechangepassword(Request $request){
        $data =$request->all();
        $old_pwd = User::where('id',Auth::User()->id)->first();
        $current_password = $data['current_password'];
        if(Hash::check($current_password,$old_pwd->password)){
            $new_pwd = Hash::make($data['new_pwd']);
            User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
            return redirect()->back()->with('flash_message_success','Yours Password is Changed Now!');
        }else{
         return redirect()->back()->with('flash_message_error','Old Password is Incorrect!');
        }
    }
    public function changeaddress()
    {
        $user_id=auth()->user()->id;
        $userDetails=User::find($user_id);
        $countries = Country::get();
        return view('wayshop.users.change_address')->with(compact('countries','userDetails'));
    }
    public function saveChangeAddress(Request $request)
    {
        $data = $request->all();
        $user_id=auth()->user()->id;
        $user = User::find($user_id);
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->country = $data['country'];
        $user->pincode = $data['pincode'];
        $user->mobile = $data['mobile'];
        $user->save();
        return redirect()->back()->with('flash_message_success','Account Details Has Been Updated!');


    }


}
