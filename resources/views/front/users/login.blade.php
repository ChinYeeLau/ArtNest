@extends('front.layout.layout')
@section('content')



    
<div class="container-fluid py-5 h-100" style="padding:0px">
  <div class="row d-flex ">
      <!-- Left Banner Section (50%) -->
      <div class="col-12 col-md-7 d-none d-md-flex " >
          <div >
              <img src="{{ asset('front/img/Group87.png') }}" alt="Banner" style="width:100%;" >
          </div>
      </div>

      <!-- Right Form Section (50%) -->
      <div class="col-12 col-md-5 d-flex justify-content-center ">
          <div class="w-75"> <!-- Adjust width as needed -->
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success</strong> {{ Session::get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" style="border:none;background-color: transparent;position: absolute;top: 0; right: 0;font-size: 1.5rem;" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error</strong> {{ Session::get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" style="border:none;background-color: transparent;position: absolute;top: 0; right: 0;font-size: 1.5rem;" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              @if($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error</strong> <?php echo implode('', $errors->all('<div>:message</div>')); ?>
                  <button type="button" class="close" data-dismiss="alert" style="border:none;background-color: transparent;position: absolute;top: 0; right: 0;font-size: 1.5rem;" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif

              <div style="padding-top:80px;" >
                  <div class="card-body p-5 text-center" >
                      <h3 class="mb-5">Login</h3>
                      <p id="login-error"></p>

                      <form id="loginForm" action="javascript:;" method="post">@csrf
                          <div class="form-outline mb-4" style="text-align: left !important;">
                            <label class="form-label" for="users-email">Email</label>
                              <input type="email" name="email" id="users-email" class="form-control form-control-lg" placeholder="user@user.com" required />
                              <p id="login-email"></p>
                          </div>

                          <div class="form-outline mb-4" style="text-align: left !important;">
                            <label class="form-label" for="users-password">Password</label>
                            <input type="password" name="password" id="users-password" class="form-control form-control-lg" placeholder="Password" required />
                              <p id="login-password"></p>
                          </div>
                          <div style="text-align: start;" >
                              <a href="{{ url('user/forgot-password') }}" style="color:darkorange !important;">Forgot password?</a>
                          </div>

                          <button class="btn btn-primary btn-lg mt-4" type="submit">Login</button>
                          <br><br>
                          <div style="text-align: start;">
                              <a href="{{ url('user/register') }}" style="color:darkorange !important;">Register Account</a>
                          </div>
                      </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
    
@endsection