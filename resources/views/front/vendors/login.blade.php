@extends('front.layout.layout')
@section('content')



      
<div class="container-fluid py-5 h-100" style="padding:0px;padding-bottom:0px !important;">
  <div class="row d-flex ">
      <!-- Left Banner Section (50%) -->
      <div class="col-12 col-md-7 d-flex d-none d-md-flex "  style="margin-top:30px;">
          <div class="login-vendor">
              <img src="{{ asset('front/img/Group97.png') }}" alt="Banner" style="width:100%;"  >
          </div>
      </div>

      <!-- Right Form Section (50%) -->
      <div class="col-12 col-md-5 d-flex justify-content-center ">
          <div class="w-75 " > <!-- Adjust width as needed -->
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
   
              <div style="padding-top:80px;" >
                <div class="card-body p-5 text-center" >
              <h3 class="mb-5">Login</h3>
              <form  action="{{url('admin/login')}}" method="post" >@csrf
              <div class="form-outline mb-3"  style="text-align: left !important;">
                <label class="form-label" for="vendor-email">Email</label>
                <input  type="email" name="email" id="email" class="form-control form-control-lg"  placeholder="vendor@vendor.com" required="" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-3"  style="text-align: left !important;">
                <label class="form-label" for="vendor-password">Password</label>
                <input type="password" name="password" id="password" class="form-control form-control-lg"  placeholder="Password"required="" class="form-control form-control-lg" />
              </div>
              <div style="text-align: start;"> 
                <a href="{{url('vendor/forgot-password')}}"style="color:darkorange !important;">Forgot Password?</a>
              </div>
              <button class=" btn-primary btn-lg mt-4 text-white" type="submit">Login</button>
  
              </form>
  
            </div>
          </div>
      </div>
  </div>
</div>
</div>
    
@endsection