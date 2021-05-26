<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\OrderDetailMail;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\ProductModel;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductsImages;
use App\Models\Cart;
use Illuminate\Support\Str;
use Session;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Country;
use App\Models\User;
use App\Models\Order;
use App\Models\OrdersProduct;
use Auth;
use DB;
class ProductController extends Controller
{

    public function index(){
        return view('admin.dashboard');
    }
    public function addproductform(){
        $categories=Category::with('categories')->where(['parent_id'=> 0])->get();
        return view('admin.products.add_product', compact('categories'));

    }
    public function viewproduct(){

        $products=ProductModel::all();
        return view('admin.products.view_product',compact('products'));
    }

    public function saveproduct(ProductRequest $request){
            try {
                $product= new ProductModel;
                $product->name = $request->product_name;
                $product->color = $request->product_color;
                $product->code = $request->product_code;
                $product->category_id= $request->category_id;
                if($request->product_description):
                    $product->description = $request->product_description;
                else:
                    $product->description = '';
                endif;
                $product->price = $request->product_price;
                $request->hasFile('image');
                $destinationPath = storage_path('app/public/products');
                $file = $request->image;
                $fileName = time() . '.'.$file->clientExtension();
                $file->move($destinationPath, $fileName);
                $product->image = $fileName;
                $status=$product->save();
                if($status){
                    return redirect()->back()->with('alert-success', 'Product Inserted Successfully');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-danger', $e->getMessage());
            }

    }
    public function deleteproduct($id){

        $id=ProductModel::find($id);
        $id->delete();
        Alert::success('Deleted Successfully', 'Record Delete Successfully');
        return redirect()->back();
    }
    public function productstatus(Request $request)
    {
        ProductModel::where('id',$request->id)->update(['status' => $request->status]);


    }
    public function addattributeform($id)
    {
        $productDetails = ProductModel::with('attributes')->where(['id'=>$id])->first();
        return view('admin.products.add_attribute',compact('productDetails'));

    }
    public function deleteAttribute($id)
    {
        $resultAttribute=ProductAttribute::where(['id'=>$id]);
        $resultAttribute->delete();
        Alert::success('Deleted Successfully', 'Attriubute Delete Successfully');
        return redirect()->back();
    }
    public function updateAttributes(Request $request, $id)
    {
        $data = $request->all();

        foreach($data['attr'] as $key=>$attr){

            ProductAttribute::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],
            'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
        }
        Alert::success('Updated Successfully', 'Attriubute Updated Successfully');
        return redirect()->back();
    }

    public function addImages($id){
        $productImages = ProductsImages::where(['product_id'=>$id])->get();
        $productDetails = ProductModel::where(['id'=>$id])->first();
        return view('admin.products.add_images')->with(compact('productDetails','productImages'));
    }
    public function saveMultipleimages(Request $request )
    {
        $files          =       array();
        $data= $request->all();

        if($request->hasfile('image'))
         {
            foreach($request->file('image') as $image)
            {
                $name               =       time().rand(1,100).'.'.$image->extension();

                if($image->move(storage_path('app/public/products'), $name)) {

                    $files[]            =       $name;
                    $upload_status      =       ProductsImages::create([
                        "image" => $name,
                        "product_id" => $data['product_id']
                        ]);

                }
            }
         }

            Alert::success('Success', 'Product Images Added Successfully');
            return redirect()->back();

    }
    public function deleteImages($id){
        $imgid=ProductsImages::find($id);
        $imgid->delete();
        Alert::success('Success', 'Image Deleted Successfully');
        return redirect()->back();
    }
    public function addAttribute(Request $request ,$id=null){
        try {
            $data= $request->all();
            foreach($data['sku'] as $key=>$value){
                $skucount=ProductAttribute::where('sku', $value)->count();
                if($skucount>0){
                    return redirect()->back()->with('alert-danger', 'Product Sku already exist Please Change one');
                }
                $sizecount=ProductAttribute::where(['product_id'=> $id,'size'=> $data['size'][$key]])->count();
                if($sizecount>0){
                    return redirect()->back()->with('alert-danger', 'Product Size already exist Please Change one');
                }
                $attribute = new ProductAttribute;
                $attribute->product_id = $id;
                $attribute->sku = $value;
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $status=$attribute->save();
            }
            if($status){
                return redirect()->back()->with('alert-success', 'Product Attributes Inserted Successfully');
            }



        }catch(\Exception $e){
            return redirect()->back()->with('alert-danger', $e->getMessage());
        }







    }

    ///////////////////////////////////////////////Website Part start//////////////////////////////////////
    public function productDetail($id=null)
    {
        $productDetails = ProductModel::with('attributes')->where('id',$id)->first();
        $ProductsAltImages = ProductsImages::where('product_id',$id)->get();
        $featuredProducts = ProductModel::where(['featured_products'=>1])->get();

        return view('wayshop.product_details')->with(compact('productDetails','ProductsAltImages','featuredProducts'));

    }
    public function addToCart(Request $request)
    {
        $user_email=auth()->user()->email;
        Session::forget('CouponAmount');
        Session::forget('countcartproduct');
        Session::forget('CouponCode');
       $data= $request->all();
       $session_id=Session::get('session_id');
       if(empty($session_id)){
           $session_id=Str::random(40);
           Session::put('session_id',$session_id);
       }



        if(empty($user_email)){
            $data['user_email'] = '';
        }else{
            $data['user_email']= $user_email;
        }
        if(empty($data['size'])){
        Alert::warning('Select Size', 'Please select Product Size');
        return redirect()->back();
        }

        $sizeArr= explode('-',$data['size']);



       $productCount=Cart::where(['product_id'=>$data['product_id']])
            ->where(['product_color'=>$data['product_color']])
            ->where(['price'=>$data['price']])
            ->where(['size'=>$sizeArr[1]])
            ->where(['session_id'=>$session_id])
            ->count();

            if($productCount > 0){
                return redirect('/cart ')->with('alert-danger', 'Product Already exist');
            }

            else{

                $cart= new Cart;
                $cart->product_id = $data['product_id'];
                $cart->product_name	 = $data['product_name'];
                $cart->product_code = $data['product_code'];
                $cart->product_color = $data['product_color'];
                $cart->size = $sizeArr[1] ;
                $cart->price = $data['price'];
                $cart->quantity = $data['quantity'];
                $cart->user_email = $data['user_email'];
                $cart->session_id = $session_id;
                $cart->save();
                $totalproductsincart= Cart::where('user_email',Auth::user()->email)->count();
               Session::put('countcartproduct',$totalproductsincart);


                return redirect('/cart')->with('alert-success','Product has been added in cart');
            }


    }
    public function cart(Request $request)
    {
        $session_id = Session::get('session_id');
        $userCart=Cart::where(['session_id'=> $session_id])->get();
        foreach($userCart as $key=>$value){
            $product_imgs=ProductModel::where(['id'=> $value->product_id])->first();
             $userCart[$key]->image=$product_imgs->image;


        }
        return view('wayshop.products.cart',compact('userCart'));
    }

    public function deleteCartProduct($id){
        Session::forget('countcartproduct');
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $id=Cart::where('id',$id);
        $id->delete();
        $totalproductsincart= Cart::where('user_email',Auth::user()->email)->count();
        Session::put('countcartproduct',$totalproductsincart);
        Alert::success('Deleted Successfully', 'Record Delete Successfully');
        return redirect()->back();
    }
    public function updateCartProduct($id=null , $qnty=null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        Cart::where(['id'=>$id])->increment('quantity',$qnty);
        return redirect()->back();

    }

    public function applycoupon(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data= $request->all();
        $couponcount=Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponcount == 0){
            return redirect()->back()->with('alert-danger', 'Coupon Code Does Not Exist');
        }else{
            $couponDetails=Coupon::where('coupon_code',$data['coupon_code'])->first();
            if($couponDetails->status ==0){
                return redirect()->back()->with('alert-danger','Coupon Code Is Not Activated');

            }
            $exp_date =$couponDetails->expiry_date;
            $current_date =date('Y-m-d');
            if($exp_date < $current_date){
                return redirect()->back()->with('alert-danger', 'Coupon Code Is Expired');
            }
            $session_id =Session::get('session_id');
            $userCart = Cart::where(['session_id'=>$session_id])->get();
            $total_amount =0;
            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price*$item->quantity);
            }
            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
                $coupon = intval($couponAmount);
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
                $coupon = intval($couponAmount);
                // echo $coupon;die;
            }
            //Add Coupon code in session
            Session::put('CouponAmount',$coupon);
            Session::put('CouponCode',$data['coupon_code']);
            return redirect()->back()->with('alert-success','Coupon Code Applied Successfully');

        }}

    public function checkout()
    {
        $user_id=auth()->user()->id;
        $user_email=auth()->user()->email;
        $shippingDetails=DeliveryAddress::where('user_id',$user_id)->first();
        $userDetails=User::find($user_id);
        $countries= Country::all();
        $shippingcount=DeliveryAddress::where('user_id',$user_id)->count();
        return view('wayshop.products.checkout')->with(compact('userDetails','countries','shippingDetails'));

    }
    public function savecheckout(Request $request)
    {
        $data= $request->all();
        $user_id= auth()->user()->id;
        $user_email= auth()->user()->email;
        $userdetails=User::where('id', $user_id)->first();
        $userdetails->name = $data['billing_name'];
        $userdetails->address = $data['billing_address'];
        $userdetails->country = $data['billing_country'];
        $userdetails->mobile = $data['billing_mobile'];
        $userdetails->city = $data['billing_city'];
        $userdetails->state = $data['billing_state'];
        $userdetails->pincode = $data['billing_pincode'];
        $userdetails->save();

        $shippingcount=DeliveryAddress::where('user_id',$user_id)->count();
        $shippingcountdetail= array();
        if($shippingcount>0){
            $shippingcountdetail=DeliveryAddress::where('user_id',$user_id)->first();

        }

        if($shippingcount>0){
            $shippingadrs=DeliveryAddress::where('user_id', $user_id)->first();

            $shippingadrs->name = $data['shipping_name'];
            $shippingadrs->address = $data['shipping_address'];
            $shippingadrs->country = $data['shipping_country'];
            $shippingadrs->mobile = $data['shipping_mobile'];
            $shippingadrs->city = $data['shipping_city'];
            $shippingadrs->state = $data['shipping_state'];
            $shippingadrs->pincode = $data['shipping_pincode'];
            $shippingadrs->update();
        }else{
            $shipping = new DeliveryAddress;
            $shipping->user_id = $user_id;
            $shipping->user_email = $user_email;
            $shipping->name = $data['shipping_name'];
            $shipping->address = $data['shipping_address'];
            $shipping->city = $data['shipping_city'];
            $shipping->state= $data['shipping_state'];
            $shipping->country =$data['shipping_country'];
            $shipping->pincode =$data['shipping_pincode'];
            $shipping->mobile = $data['shipping_mobile'];
            $shipping->save();
        }
        return redirect('orderReview');

    }

    public function orderReview()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();

        $userDetails=User::find($user_id);
        $userCart=Cart::where(['user_email'=>$user_email])->get();

        foreach($userCart as $key=>$product){
           $productdetail= ProductModel::where('id', $product->product_id)->first();
           $userCart[$key]->image = $productdetail->image;
        }

        return view('wayshop.products.order_review',compact('shippingDetails', 'userCart','userDetails' ));

    }
    public function placeOrder(Request $request)
    {
        $data= $request->all();
        $user_email= auth()->user()->email;
        $user_id= auth()->user()->id;
        $shippingDetails=DeliveryAddress::where(['user_email'=>$user_email])->first();
        if(empty(Session::get('CouponCode'))){
            $couponCode= "Not Found";
        }else{
            $couponCode=Session::get('CouponCode');
        }
        if(empty(Session::get('CouponAmount'))){
            $couponamount= 0 ;
        }else{
            $couponamount= Session::get('CouponAmount');
        }

        $order=new Order;
        $order->user_id = $user_id;
        $order->user_email = $user_email;
        $order->name = $shippingDetails->name;
        $order->address = $shippingDetails->address;
        $order->city = $shippingDetails->city;
        $order->state = $shippingDetails->state;
        $order->pincode = $shippingDetails->pincode;
        $order->country = $shippingDetails->country;
        $order->mobile = $shippingDetails->mobile;
        $order->coupon_code = $couponCode;
        $order->coupon_amount = $couponamount;
        $order->order_status = "New";
        $order->payment_method = $data['payment_method'];
        $order->grand_total = $data['grand_total'];
        $order->Save();

        $order_id=$order->id;
        $cartproducts=Cart::where(['user_email'=>$user_email])->get();
        foreach($cartproducts as $pro){
            $cartPro = new OrdersProduct;
            $cartPro->order_id = $order_id;
            $cartPro->user_id = $user_id;
            $cartPro->product_id = $pro->product_id;
            $cartPro->product_code = $pro->product_code;
            $cartPro->product_name = $pro->product_name;
            $cartPro->product_color = $pro->product_color;
            $cartPro->product_size = $pro->size;
            $cartPro->product_price = $pro->price;
            $cartPro->product_qty = $pro->quantity;
            $cartPro->save();
        }
        Session::put('order_id',$order_id);
        Session::put('grand_total',$data['grand_total']);
        if($data['payment_method']=="cod"){
            return redirect('/thanks');
        }else{
            return redirect('/stripe');
        }

    }
    public function thanks()
    {
        $user_email = Auth::user()->email;
        Cart::where(['user_email' => $user_email])->delete();
        return view('wayshop.orders.thanks');
    }
    public function userOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('wayshop.orders.user_orders')->with(compact('orders'));

    }
    public function userOrderDetails($order_id)
    {
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('wayshop.orders.user_order_details')->with(compact('orderDetails','userDetails'));

    }
    public function stripe()
    {
        return view('wayshop.orders.stripe');
    }
    public function paystripe(Request $request)
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        if($request->isMethod('post')){
            $data = $request->all();
            \Stripe\Stripe::setApiKey('sk_test_51HYPbbCsVtSxdbpXlo78QzOhoMDUAumHSphsa2DAN6VRBJCSar3CHSemZIzRvtmPvhviviStgPGXVTG2lUG4uQbG00lyZN92yE');

            $token = $_POST['stripeToken'];
            $charge = \Stripe\charge::Create([

              'amount' => $request->input('total_amount')*100,
              'currency' => 'pkr',
              'description' => $request->input('name'),
              'source' => $token,
            ]);
$userid=Auth::user()->id;
$orderdetail=Order::with('orders')->where('user_id',$userid)->orderBy('id','desc')->first();
$details= [

    'name'=> $orderdetail['name'],
    'city'=> $orderdetail['city'],
    'address'=> $orderdetail['address'],
    'country'=> $orderdetail['country'],
    'mobile'=> $orderdetail['mobile'],
    'shipping_charges'=> $orderdetail['shipping_charges'],
    'order_status'=> $orderdetail['order_status'],
    'payment_method'=> $orderdetail['payment_method'],
    'grand_total'=> $orderdetail['grand_total'],
    'id'=>$orderdetail['id']
];



        \Mail::to('TheWayShop@gmail.com')->send(new \App\Mail\OrderDetailMail($details,$orderdetail));
Session::forget('order_id');
Session::forget('grand_total');
Session::forget('countcartproduct');

            return redirect()->back()->with('flash_message_success','Your Payment Successfully Done!'."<br>".'Check Your Email For Details');
        }
    }

    //////////////////////////////////////Admin panal Start
    public function viewuserOrders()
    {
        $orders = Order::with('orders')->orderBy('id','DESC')->get();
        // echo "<pre>";
        // print_r($orders);
        // echo "</pre>";

        return view('admin.orders.user_order')->with(compact('orders'));
    }
    public function orderDetails($order_id)
    {
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }
    public function updateOrderStatus(Request $request)
    {
        $data= $request->all();
        Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
        return redirect()->back()->with('flash_message_success','Order Status has been updated successfully!');
    }
}
