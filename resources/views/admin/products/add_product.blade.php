@extends('admin.layouts.master')
@section('title', 'Add Product')

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-product-hunt"></i>
       </div>
       <div class="header-title">
          <h1>Add Product</h1>
          <small>Add Products</small>
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
                      <a class="btn btn-add " href="">
                      <i class="fa fa-eye"></i>  View Products </a>
                   </div>
                </div>
                <div class="panel-body">
                <form class="col-sm-6" enctype="multipart/form-data" action="saveproduct" method="post">
                     @csrf
                      <div class="form-group">
                        <label>Under Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                        <option>Select Category</opion>

                        @foreach($categories as $cat)

                        <option value="{{ $cat->id }}">{{ $cat->name }}</opion>
                         @foreach($cat->categories as $subcat)
                         <option value="{{ $subcat->id }}">&nbsp;--&nbsp;{{ $subcat->name }}</opion>
                         @endforeach

                        @endforeach

                        </select>

                     </div>
                      <div class="form-group">
                         <label>Product Name</label>
                         <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" id="product_name" >
                         @if($errors->has('product_name'))<p class="error text-danger inputerror">{{ $errors->first('product_name') }}</p>@endif
                      </div>
                      <div class="form-group">
                         <label>Product Code</label>
                         <input type="text" class="form-control" placeholder="Enter Product Code" name="product_code" id="product_code" >
                         @if($errors->has('product_code'))<p class="error text-danger inputerror">{{ $errors->first('product_code') }}</p>@endif
                      </div>
                      <div class="form-group">
                         <label>Product Color</label>
                         <input type="text" class="form-control" placeholder="Enter Product Color" name="product_color" id="product_color" >
                         @if($errors->has('product_color'))<p class="error text-danger inputerror">{{ $errors->first('product_color') }}</p>@endif
                      </div>
                      <div class="form-group">
                         <label>Product Description</label>
                         <textarea name="product_description" id="product_description" class="form-control">                         </textarea>
                         @if($errors->has('product_description'))<p class="error text-danger inputerror">{{ $errors->first('product_description') }}</p>@endif
                      </div>
                      <div class="form-group">
                         <label>Product Price</label>
                         <input type="text" class="form-control" placeholder="Enter Price" name="product_price" id="product_price" >
                         @if($errors->has('product_price'))<p class="error text-danger inputerror">{{ $errors->first('product_price') }}</p>@endif
                      </div>
                      <div class="form-group">
                        <label>Picture upload</label>
                        <input type="file" name="image">
                        @if($errors->has('image'))<p class="error text-danger inputerror">{{ $errors->first('image') }}</p>@endif
                     </div>
                      <div class="reset-button">
                         <input type="submit" class="btn btn-success" value="Add Product">
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
