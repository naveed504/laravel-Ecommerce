@extends('admin.layouts.master')
@section('title','View Products')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-product-hunt"></i>
       </div>
       <div class="header-title">
          <h1>View Products</h1>
          <small>Products List</small>
       </div>
    </section>
    <!-- Main content -->
    <section class="content">
       <div class="row">
          <div class="col-sm-12">
          <div id="message_success" style="display:none;" class="alert alert-sm alert-success">Status Enabled</div>
    <div id="message_error" style="display:none;" class="alert alert-sm alert-danger">Status Disabled</div>

             <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                   <div class="btn-group" id="buttonexport">
                      <a href="#">
                         <h4>View Products</h4>
                      </a>
                   </div>
                </div>
                <div class="panel-body">
                <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                   <div class="btn-group">
                      <div class="buttonexport" id="buttonlist">
                      <a class="btn btn-add" href=""> <i class="fa fa-plus"></i> Add Product
                         </a>
                      </div>
                   </div>
                   <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                   <div class="table-responsive">
                      <table id="table_id" class="table table-bordered table-striped table-hover">
                         <thead>
                            <tr class="info">
                               <th>ID</th>
                               <th>Product Name</th>
                               <!-- <th>Category ID</th> -->
                               <th>Product Code</th>
                               <th>Product Color</th>
                               <th>Image</th>
                               <th>Price</th>
                               <th>Status</th>
                               <!-- <th>Featured Products</th>  -->
                               <th>Action</th>
                            </tr>
                         </thead>
                         <tbody>
                             @foreach($products as $product)
                            <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <!-- <td>{{$product->category_id}}</td> -->
                               <td>{{$product->code}}</td>
                               <td>{{$product->color}}</td>
                               <td>
                                   @if(!empty($product->image))
                               <img src="{{asset('storage/products/'.$product->image)}}" alt="" style="width:100px;">
                               </td>
                               @endif
                               <td>{{$product->price}}</td>
                                <td>
                               <input type="checkbox" class="ProductStatus btn btn-success" rel="{{$product->id}}"
                               data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"
                               @if($product->status == "1") checked @endif>
                               <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                               </td>
                               <!-- <td>
                                 <input type="checkbox" class="FeaturedStatus btn btn-success" rel="{{$product->id}}"
                                 data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"
                                 @if($product['status']=="1") checked @endif>
                                 <div id="myElem" style="display:none;" class="alert alert-success">Status Enabled</div>
                                 </td> -->
                               <td>
                               <a href="{{url('addattributeform/'.$product->id)}}" class="btn btn-warning btn-sm" title="Add Attributes"><i class="fa fa-list"></i></button>
                               <a href="deleteproduct/{{$product->id}}" class="btn btn-danger btn-sm" title="Delete Product"><i class="fa fa-trash-o"></i> </a>
                               <a href="addimages/{{$product->id}}" class="btn btn-info btn-sm" title="Add Images"><i class="fa fa-image"></i></button>
                                 </td>
                            </tr>
                             @endforeach
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
@endsection
