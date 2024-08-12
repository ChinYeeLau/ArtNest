@extends('front.layout.layout')
@section('content')



    
<div class="container-fluid py-5 h-100" style="padding:0px">
  <div class="row d-flex " >
      <!-- Left Banner Section (50%) -->
      <div class="col-12 col-md-7 d-none d-md-flex " >
          <div >
              <img src="{{asset('front/images/banner_images/4839.png')}}" alt="Banner" style="width:100%;" >
          </div>
      </div>

      <!-- Right Form Section (50%) -->
      <div class="col-12 col-md-5 d-flex justify-content-center ">
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
              <div style="padding-top:50px;">
                <div class="card-body p-5 text-center" >
                <h3 class="mb-5">Register</h3>
                <form id="vendorForm" action="{{ url('/vendor/register') }}" method="POST">@csrf
                   
                    <div class="form-outline mb-4">
                      <label class="form-label" for="vendorname">Username</label>
                        <input type="text" name="name" id="vendorname" placeholder="Vendor Name" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="vendormobile">Mobile</label>
                        <input type="text" name="mobile" id="vendormobile" placeholder="Vendor Mobile" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="vendoremail">Email</label>
                        <input type="email" name="email" id="vendoremail" placeholder="vendor@vendor.com" class="form-control form-control-lg" />
                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="vendorpassword">Password</label>
                        <input type="password" name="password" id="vendorpassword" placeholder="Vendor Password"class="form-control form-control-lg" />
                    </div>
                    <div class="form-check d-flex justify-content-start mb-4">
                        <input class="form-check-input" type="checkbox"  id="accept" name="accept">
                        <label class="form-check-label" for="accept">I've read and accept the
                             <a href="terms-and-conditions.html" class="red-text">term & condition</a></label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                </form>
                
              </div>
            </div>
        </div>
    </div>
</div>
</div>
    
@endsection