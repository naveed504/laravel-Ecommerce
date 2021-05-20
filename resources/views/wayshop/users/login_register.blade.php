@extends('wayshop.layouts.master')
@section('content')

<div class="contact-box-main">

    <div class="container">

     <div class="row">
         <div class="col-lg-5 col-sm-12">
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
                 <h2>New User SignUp !</h2>
                 <form action="{{url('/user-register')}}" method="POST" id="contactForm registerForm">
                 @csrf
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Your Name" id="name" name="name"  data-error="Please Enter Your Name">
                                 @if($errors->has('name'))
                                 <div class="help-block with-errors">{{ $errors->first('name') }}</div>
                                 @endif

                             </div>

                         </div>
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
                                <button class="btn hvr-hover" id="submit" type="submit">Signup</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                     </div>
                 </form>
             </div>

         </div>
         <div class="col-lg-1 col-sm-12" id="or">
          OR
         </div>
         <div class="col-lg-6 col-sm-12">
         @if(Session::has('alert-successs'))
                        <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success !</strong> {{Session::get('alert-successs')}}
                        </div>
                        @endif
                        @if(Session::has('alert-dangerr'))
                        <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Error !</strong> {{Session::get('alert-dangerr')}}
                        </div>
                        @endif
            <div class="contact-form-right">
                <h2>Already a Member ? Just SignIn !</h2>
                <form action="{{url('loginuser')}}" method="post" id="contactForm LoginForm">
                @csrf
                    <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                               <input type="text" class="form-control" placeholder="Your Email" id="email" name="email" required data-error="Please Enter Your Email">
                               <div class="help-block with-errors"></div>
                           </div>

                       </div>
                       <div class="col-md-12">
                           <div class="form-group">
                               <input type="password" class="form-control" placeholder="Password" id="password" name="password" required data-error="Please Enter Your Password">
                               <div class="help-block with-errors"></div>
                           </div>

                       </div>
                       <div class="col-md-12">
                           <div class="submit-button text-center">
                               <button class="btn hvr-hover" id="submit" type="submit">Login</button>
                               <div id="msgSubmit" class="h3 text-center hidden"></div>
                               <div class="clearfix"></div>
                           </div>

                       </div>
                    </div>
                </form>
                <a href="{{url('forgot-password')}}">Forgot Password</a>
            </div>
         </div>
     </div>
    </div>

</div>

@endsection