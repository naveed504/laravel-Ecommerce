@extends('admin.layouts.master')
@section('title','Add Coupon')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-product-hunt"></i>
       </div>
       <div class="header-title">
          <h1>Add Coupon</h1>
          <small>Add Coupons</small>
       </div>
    </section>

    <!-- Main content -->
    <section class="content">
       <div class="row">
          <!-- Form controls -->
          <div class="col-sm-12">
          @if(Session::has('alert-success'))
                        <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success !</strong> {{Session::get('alert-success')}}
                        </div>
                        @endif
                        @if(Session::has('alert-danger'))
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error !</strong> {{Session::get('alert-danger')}}
                        </div>
                        @endif
             <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                   <div class="btn-group" id="buttonlist">
                      <a class="btn btn-add " href="{{url('admin/view-coupons')}}">
                      <i class="fa fa-eye"></i>  View Coupons </a>
                   </div>
                </div>
                <div class="panel-body">
                <form class="col-sm-6" enctype="multipart/form-data" action="{{url('save-coupon')}}" method="post" name="add_coupon" id="add_coupon"> {{csrf_field()}}

                      <div class="form-group">
                         <label>Coupon Code</label>
                         <input type="text" class="form-control" placeholder="Enter Coupon Code" name="coupon_code" id="coupon_code" required>
                      </div>
                      <div class="form-group">
                         <label>Amount</label>
                         <input type="text" class="form-control" placeholder="Enter Amount" name="coupon_amount" id="coupon_amount" required>
                      </div>
                      <div class="form-group">
                        <label>Amount Type</label>
                        <select name="amount_type" id="amount_type" class="form-control">
                         <option value="Percentage">Percentage</option>
                         <option value="Fixed">Fixed</option>
                        </select>
                     </div>
                      <div class="form-group">
                         <label>Expiry Date</label>
                         <input type="text" class="form-control" name="expiry_date" id="datepicker" required>
                      </div>

                      <div class="reset-button">
                         <input type="submit" class="btn btn-success" value="Add Coupon">
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

@endsection