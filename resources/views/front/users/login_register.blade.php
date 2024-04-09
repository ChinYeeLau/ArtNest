@extends('front.layout.layout')
@section('content')



    
    <div class="container py-5 h-100">
        
      <div class="row d-flex justify-content-center align-items-start h-100" style="padding-top:200px">
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
  
              <h3 class="mb-5">Login</h3>
              <p id="login-error"></p>
              <form id="loginForm" action="javascript:;" method="post" >@csrf
              <div class="form-outline mb-4">
                <label class="form-label" for="users-email">Email</label>
                <input  type="email" name="email" id="users-email" class="form-control form-control-lg"  placeholder="Username" required="" class="form-control form-control-lg" />
               <p id="login-email"></p>
              </div>
  
              <div class="form-outline mb-4">
                <label class="form-label" for="users-password">Password</label>
                <input type="password" name="password" id="users-password" class="form-control form-control-lg"  placeholder="Password"required="" class="form-control form-control-lg" />
                <p id="login-password"></p>
              </div>
  
              <!-- Checkbox -->
              
               
                  
             
              <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
  
              </form>
  
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <h3 class="mb-5">Register</h3>
                <form id="registerForm" action="javascript:;" method="POST">@csrf
                   
                    <div class="form-outline mb-4">
                      <label class="form-label" for="user-name">Username</label>
                        <input type="text" name="name" id="user-name" placeholder="User Name" class="form-control form-control-lg" />
                        <p id="register-name"></p>
                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="user-mobile">Mobile</label>
                        <input type="text" name="mobile" id="user-mobile" placeholder="User Mobile" class="form-control form-control-lg" />
                        <p id="register-mobile"></p>
                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="user-email">Email</label>
                        <input type="email" name="email" id="user-email" placeholder="user@user.com" class="form-control form-control-lg" />
                        <p id="register-email"></p>
                    </div>
                    <div class="form-outline mb-4">
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
                              
                             
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                </form>
                
              </div>
            </div>
          </div>
      </div>
    </div>
    
@endsection