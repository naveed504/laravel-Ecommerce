@extends('wayshop.layouts.master')
@section('content')

<div class="contact-box-main">

    <div class="container">

     <div class="row">
     <div class="col-lg-3"></div>
         <div class="col-lg-6">
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
                 <h2>Reset Password</h2>
                 <form action="{{url('reset-new-password')}}" method="POST" id="contactForm registerForm">
                 @csrf
                     <div class="row">
                     <input type="hidden" name="token" value="{{ $token }}">
                         <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Email" id="email" name="email"  data-error="Please Enter Your Email">
                                @if($errors->has('email'))
                                 <div class="help-block with-errors">{{ $errors->first('email') }}</div>
                                 @endif
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password"  data-error="Please Enter Your Password">
                                @if($errors->has('password'))
                                 <div class="help-block with-errors">{{ $errors->first('password') }}</div>
                                 @endif
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confrim Password" id="password_confirmation" name="password_confirmation"  data-error="Please Enter Your Confrim Password">
                                @if($errors->has('password_confirmation'))
                                 <div class="help-block with-errors">{{ $errors->first('password_confirmation') }}</div>
                                 @endif
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Reset Password</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                     </div>
                 </form>
             </div>

         </div>


     </div>
    </div>

</div>

@endsection