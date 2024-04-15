@extends('front.layout.layout')
@section('content')



    
    <div class="container py-5 h-100">
        
      <div class="row d-flex justify-content-center align-items-start h-100" style="padding-top:100px">
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
              <form  action="{{url('admin/login')}}" method="post" >@csrf
              <div class="form-outline mb-4">
                <input  type="email" name="email" id="email" class="form-control form-control-lg"  placeholder="Username" required="" class="form-control form-control-lg" />
                <label class="form-label" for="vendor-email">Email</label>
              </div>
  
              <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control form-control-lg"  placeholder="Password"required="" class="form-control form-control-lg" />
                <label class="form-label" for="vendor-password">Password</label>
              </div>
  
              <!-- Checkbox -->
              
               
                  
             
              <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
  
              </form>
  
            </div>
          </div>
        </div>
       
      </div>
    </div>
    
@endsection