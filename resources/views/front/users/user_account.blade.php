@extends('front.layout.layout')
@section('content')



    
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center h-100" style="padding-top:100px">
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
   
              
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <h3 class="md-6 ">Update Contact Details</h3>
                <p id="account-error"></p>
              <p id="account-success"></p>
                <form id="accountForm" action="javascript:;" method="POST">@csrf

                    <div class="form-outline mb-4">
                      <label class="form-label" for="user-email">Email</label>
                        <input type="email" name="email" id="user-email"  class="form-control form-control-lg" value="{{Auth::user()->email}}" readonly=""/>
                        <p id="account-email"></p>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="user-name">Name</label>
                          <input type="text" name="name" id="user-name"  class="form-control form-control-lg" value="{{Auth::user()->name}}" />
                          <p id="account-name"></p>
                      </div>
                      <div class="form-outline mb-4">
                        <label class="form-label" for="user-address">Full Address</label>
                          <input type="text" name="address" id="user-address"  class="form-control form-control-lg" value="{{Auth::user()->address}}" />
                          <p id="account-address"></p>
                      </div>
                      <div class="form-outline mb-4">
                        <label class="form-label" for="user-state">State</label>
                          <input type="text" name="state" id="user-state"  class="form-control form-control-lg" value="{{Auth::user()->state}}" />
                          <p id="account-state"></p>
                      </div>
                      <div class="form-outline mb-4">
                        <label class="form-label" for="user-mobile">Mobile</label>
                          <input type="text" name="mobile" id="user-mobile"  class="form-control form-control-lg" value="{{Auth::user()->mobile}}" />
                          <p id="account-mobile"></p>
                      </div>
                     
                      
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Update </button>
                    </form>
            </div>
        </div>
        </div>

                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                      <div class="card-body p-5 text-center">
                        <h3 class="md-6">Update Password</h3>
                        <p id="password-error"></p>
                        <p id="password-success"></p>
                        <form id="passwordForm" action="javascript:;" method="POST">@csrf
                           
                      <div class="form-outline mb-4">
                        <label class="form-label" for="current-password">Current Password</label>
                          <input type="password" name="current_password" id="current-password"  placeholder="Current Password" class="form-control form-control-lg" value="" />
                          <p id="password-current_password"></p>
                      </div>
                      <div class="form-outline mb-4">
                        <label class="form-label" for="new-password">New Password</label>
                          <input type="password" name="new_password" id="new-password"  placeholder="New Password" class="form-control form-control-lg" value="" />
                          <p id="password-new_password"></p>
                      </div>
                      <div class="form-outline mb-4">
                        <label class="form-label" for="confirm-password">Confirm Password</label>
                          <input type="password" name="confirm_password" id="confirm-password"  placeholder="Confirm Password" class="form-control form-control-lg" value="" />
                          <p id="password-confirm_password"></p>
                      </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Update </button>
                </form>
              </div>
            </div>
        </div>
    </div>
   
</div>
@endsection