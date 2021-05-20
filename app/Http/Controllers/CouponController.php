<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use RealRashid\SweetAlert\Facades\Alert;


class CouponController extends Controller
{
    public function viewCoupon()
    {
        $coupons =Coupon::all();
return view('admin.coupons.view_coupon',compact('coupons'));
    }
    public function coupon()
    {

        return view('admin.coupons.add_coupon');

    }
    public function saveCoupon(Request $request)

    {
        try {
            $data=$request->all();
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['coupon_amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $status=$coupon->save();
            if($status){
                return redirect()->back()->with('alert-success', 'Coupon Inserted Successfully');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('alert-danger', $e->getMessage());
        }


    }

    public function couponstatus(Request $request)
    {

        Coupon::where('id',$request->id)->update(['status' => $request->status]);
    }
    public function deletecoupon($id)
    {
        $id=Coupon::where('id',$id);
        $id->delete();
        Alert::success('Deleted Successfully', 'Attriubute Delete Successfully');
        return redirect()->back();
    }
}
