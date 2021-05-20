<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserAccountController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Route for admin TO Manage Products and its Attribtes
Route::get('admin', [ProductController::class, 'index']);
Route::get('addproduct-form', [ProductController::class, 'addproductform']);
Route::post('saveproduct', [ProductController::class, 'saveproduct']);
Route::get('view-products', [ProductController::class, 'viewproduct']);
Route::get('deleteproduct/{id}', [ProductController::class, 'deleteproduct']);
Route::post('productstatus', [ProductController::class, 'productstatus']);
Route::get('addattributeform/{id}', [ProductController::class, 'addattributeform']);
Route::post('add-attributes/{id}',[ProductController::class,'addAttribute']);
Route::get('delete-attribute/{id}',[ProductController::class,'deleteAttribute']);
Route::post('updateattributes/{id}', [ProductController::class,'updateAttributes']);
Route::get('addimages/{id}',[ProductController::class,'addImages']);
Route::post('saveMultipleimages',[ProductController::class, 'saveMultipleimages']);
Route::get('delete-alt-image/{id}',[ProductController::class,'deleteImages']);


//Route for admin TO Manage Categories and its Attribtes
Route::get('addcategory-form',[CategoryController::class, 'addcategoryform']);
Route::post('savecategory',[CategoryController::class, 'savecategory']);
Route::get('view-categories',[CategoryController::class, 'viewcategory']);
Route::get('edit-category/{id}',[CategoryController::class,'editcategory']);
Route::post('updatecategory/{id}',[CategoryController::class,'updatecategory']);
Route::get('delete-category/{id}',[CategoryController::class,'deletecategory']);
Route::post('categoriesstatus',[CategoryController::class,'categoriesstatus']);

//Route for admin TO Manage Banners
Route::get('banner',[BannerController::class,'banner']);
Route::get('showbanners',[BannerController::class,'showbanner']);
Route::post('savebanner',[BannerController::class,'savebanner']);



//Route for admin To Manage Coupons
Route::get('add-coupon',[CouponController::class,'coupon']);
Route::post('save-coupon',[CouponController::class,'saveCoupon']);
Route::get('view-coupon',[CouponController::class, 'viewCoupon']);
Route::post('couponstatus',[CouponController::class, 'couponstatus']);
Route::get('delete-coupon/{id}',[CouponController::class, 'deletecoupon']);



//Route for Admin to Manage Orders
Route::get('view-orders',[ProductController::class, 'viewuserOrders']);
Route::get('order-detail/{id}',[ProductController::class,'orderDetails']);
Route::post('update-order-status',[ProductController::class,'updateOrderStatus']);


//Route for Frontend
Route::get('/',[IndexController::class,'index']);
Route::get('product-deail/{id}',[ProductController::class, 'productDetail']);
Route::get('categories/{subcat}',[IndexController::class,'displaySubCategory']);
Route::get('getproductprice',[IndexController::class,'getPrice']);

//Route for Cart
Route::post('add-cart',[ProductController::class, 'addToCart']);
Route::get('/cart',[ProductController::class, 'cart']);
Route::get('cart/delete-product/{id}',[ProductController::class, 'deleteCartProduct']);
Route::get('cart/update-quantity/{id}/{qnty}',[ProductController::class, 'updateCartProduct']);

//Route for Apply Coupons
Route::post('cart/apply-coupon',[ProductController::class,'applycoupon']);
//Route for checkout
Route::get('checkout', [ProductController::class, 'checkout']);
Route::post('save-heckout', [ProductController::class, 'savecheckout']);
Route::get('orderReview', [ProductController::class, 'orderReview']);
Route::post('place-order', [ProductController::class, 'placeOrder']);
Route::get('thanks',[ProductController::class, 'thanks']);
Route::get('orders',[ProductController::class, 'userOrders']);
Route::get('orders/{id}',[ProductController::class, 'userOrderDetails']);
//stripe payment integration
Route::get('stripe',[ProductController::class, 'stripe']);
Route::post('pay-stripe',[ProductController::class, 'paystripe']);











//Route for Register
Route::get('register', [RegisterController::class ,'register']);
Route::post('user-register', [RegisterController::class ,'userRegister']);
//Route for Login
Route::post('loginuser', [LoginController::class ,'authenticate']);
Route::get('logout', [LoginController::class, 'logout']);
//Route For Forgot Password
Route::get('forgot-password',[ForgotPasswordController::class, 'forgot']);
Route::post('recover-forgot-password',[ForgotPasswordController::class, 'recoverpassword']);
Route::get('reset-password/{token}',[ResetPasswordController::class, 'resetpassword']);
Route::post('reset-new-password', [ResetPasswordController::class, 'updatePassword']);



//Route for UserAccount
Route::get('account',[UserAccountController::class, 'account']);
Route::get('change-password',[UserAccountController::class, 'changepassword']);
Route::post('savechangepassword',[UserAccountController::class, 'savechangepassword']);
Route::get('change-address',[UserAccountController::class, 'changeaddress']);
Route::post('save-change-address',[UserAccountController::class, 'saveChangeAddress']);















