@extends('wayshop.layouts.master')
@section('content')

<div class="contact-box-main">

    <div class="container">

     <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6">
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
             <div class="contact-form-right">
                 <h2>Forgot Password</h2>
                 <form action="{{url('recover-forgot-password')}}" method="POST" id="contactForm registerForm">
                 @csrf
                     <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Regstered Email" id="email" name="email" required data-error="Please Enter Your Password">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Send</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                     </div>
                 </form>
             </div>

         </div>
         <div class="col-md-3"></div>
     </div>
    </div>

</div>

@endsection