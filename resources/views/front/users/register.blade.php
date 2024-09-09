@extends('front.layout.layout')
@section('content')



    
<div class="container-fluid py-5 h-100" style="padding:0px">
  <div class="row d-flex " >
      <!-- Left Banner Section (50%) -->
      <div class="col-12 col-md-7 d-none d-md-flex "  style="margin-top:30px;" >
          <div >
              <img src="{{ asset('front/img/Group87.png') }}" alt="Banner" style="width:100%;" >
          </div>
      </div>

      <!-- Right Form Section (50%) -->
      <div class="col-12 col-md-5 d-flex justify-content-center">
          <div class="w-75"> <!-- Adjust width as needed -->
        @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" style="border:none;background-color: transparent;position: absolute;top: 0; right: 0;font-size: 1.5rem;"aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" style="border:none;background-color: transparent;position: absolute;top: 0; right: 0;font-size: 1.5rem;"aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              @if($errors->any())              
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong>  <?php echo implode('', $errors->all('<div>:message</div>')); ?>
                <button type="button" class="close" data-dismiss="alert" style="border:none;background-color: transparent;position: absolute;top: 0; right: 0;font-size: 1.5rem;" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
   
      
              <div  style="padding-top:20px;">
                <div class="card-body p-5 text-center" >
                <h3 class="mb-5">Register</h3>
                <p id="register-error"></p>
                <p id="register-success"></p>
                <form id="registerForm" action="javascript:;" method="POST">@csrf
                   
                    <div class="form-outline mb-2"  style="text-align: left !important;">
                      <label class="form-label" for="user-name">Username</label>
                        <input type="text" name="name" id="user-name" placeholder="Username" class="form-control form-control-lg" />
                        <p id="register-name"></p>
                    </div>
                    <div class="form-outline mb-2"  style="text-align: left !important;">
                      <label class="form-label" for="user-mobile">Mobile</label>
                        <input type="text" name="mobile" id="user-mobile" placeholder="User Mobile" class="form-control form-control-lg" />
                        <p id="register-mobile"></p>
                    </div>
                    <div class="form-outline mb-2"  style="text-align: left !important;">
                      <label class="form-label" for="user-email">Email</label>
                        <input type="email" name="email" id="user-email" placeholder="user@user.com" class="form-control form-control-lg" />
                        <p id="register-email"></p>
                    </div>
                    <div class="form-outline mb-2"  style="text-align: left !important;">
                      <label class="form-label" for="user-password">Password</label>
                        <input type="password" name="password" id="user-password" placeholder="User Password"class="form-control form-control-lg" /> 
                        <p id="register-password"></p>
                    </div>
                    <div class="form-check d-flex justify-content-start ">
                        <input class="form-check-input" type="checkbox"  id="accept" name="accept">
                        <label class="form-check-label" for="accept">I've read and accept the
                             <a href="terms-and-conditions.html" class="red-text">term & condition</a>
                            </label>
                            </div>
                            <p id="register-accept"></p>
                              
                             
                    <button class=" btn-primary btn-lg btn-block text-white" type="submit">Register</button>
                   <div style="text-align: start;padding-top:10px;"> 
                      <a href="{{url('user/login')}}" style="color:darkorange !important;">Already have an account?</a>
                    </div>
                  </form>
               
              </div>
              </div>
          </div>
      </div>
  </div>
</div>
    
@endsection