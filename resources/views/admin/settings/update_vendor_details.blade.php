@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Update Vendor Details</h3>
                      
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($slug=="personal")
       
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title">Update  Personal Information</h4>
                    @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error</strong> {{Session::get('error_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success</strong> {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                @if ($errors->any())
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                    @endforeach
              
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  @endif
                    <form class="forms-sample" action="{{url('admin/update-vendor-details/personal')}}" method="post" enctype="multipart/form-data" >@csrf
                    
                      <div class="form-group">
                        <label >Vendor Username/Email</label>
                        <input class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly="">
                      
                  
                      </div>
                      <div class="form-group">
                        <label for="vendor_name">Name</label>
                        <input type="text" class="form-control" id="vendor_name" placeholder="Enter Name" name="vendor_name"value="{{$vendorDetails['name']}}" required="">
                      </div>
                      <div class="form-group">
                          <label for="vendor_state">State</label>
                          <input type="text" class="form-control" id="vendor_state" placeholder="Enter State" name="vendor_state"value="{{$vendorDetails['state']}}" required="" >
                        </div>
                      <div class="form-group">
                        <label for="vendor_mobile">Mobile</label>
                        <input type="text" class="form-control" id="vendor_mobile" placeholder="Enter 10 Digit Mobile Number" name="vendor_mobile"value="{{$vendorDetails['mobile']}}" required="" maxlength="10"minlength="10">
                      </div>
                      <div class="form-group">
                        <label for="vendor_curent_status">Current Status</label>
                        <input type="text" class="form-control" id="vendor_current_status" placeholder="Are you looking for job or a freelancer?" name="vendor_current_status"value="{{$vendorDetails['current_status']}}" required="" >
                      </div>
                     
                      <div class="form-group">
                        <label for="vendor_image"> Photo</label>
                        <input type="file" class="form-control" id="vendor_image"  name="vendor_image" >
                        @if(!empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{url('admin/images/photos/'.Auth::guard('admin')->user()->image)}}">View Image</a>
                        <input type="hidden" name="current_vendor_image" value="{{Auth::guard('admin')->user()->image}}">
                        @endif
                      </div>
                      
                      <div class="form-check form-check-flat form-check-primary">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
      </div>
            
            @elseif($slug=="business")
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        
                        <h4 class="card-title">Update  Business Information</h4>
                        @if(Session::has('error_message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error</strong> {{Session::get('error_message')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success</strong> {{Session::get('success_message')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                    @if ($errors->any())
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                        @endforeach
                  
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      @endif
                        <form class="forms-sample" action="{{url('admin/update-vendor-details/business')}}" method="post" enctype="multipart/form-data" >@csrf
                        
                          <div class="form-group">
                            <label >Vendor Username/Email</label>
                            <input class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly="">
                          
                      
                          </div>
                          <div class="form-group">
                            <label for="shop_name">Shop Name</label>
                            <input type="text" class="form-control" id="shop_name" placeholder="Enter Name" name="shop_name" @if(isset($vendorDetails['shop_name']))value="{{$vendorDetails['shop_name']}}" @endif required="">
                          </div>
                          <div class="form-group">
                              <label for="shop_state">Shop State</label>
                              <input type="text" class="form-control" id="shop_state" placeholder="Enter State" name="shop_state"@if(isset($vendorDetails['shop_state']))value="{{$vendorDetails['shop_state']}}" @endif required="" >
                            </div>
                          <div class="form-group">
                            <label for="shop_mobile">Shop Mobile</label>
                            <input type="text" class="form-control" id="shop_mobile" placeholder="Enter 10 Digit Mobile Number" name="shop_mobile"@if(isset($vendorDetails['shop_mobile']))value="{{$vendorDetails['shop_mobile']}}"  @endif required="" maxlength="10"minlength="10">
                          </div>
                          <div class="form-group">
                            <label for="shop_website">Shop Website</label>
                            <input type="text" class="form-control" id="shop_mobile" placeholder="Any Website?If No,May Ignore." name="shop_website"@if(isset($vendorDetails['shop_website']))value="{{$vendorDetails['shop_website']}}" @endif >
                          </div>
                          <div class="form-group">
                            <label for="shop_email">Shop Email</label>
                            <input type="email" class="form-control" id="shop_email" placeholder="Shop Email or Personal Email" name="shop_email"@if(isset($vendorDetails['shop_email'])) value="{{$vendorDetails['shop_email']}}" @endif required="" >
                          </div>
                         
                        
                          <div class="form-check form-check-flat form-check-primary">
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
                
            @elseif($slug=="bank")
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      
                      <h4 class="card-title">Update  Bank Information</h4>
                      @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{Session::get('error_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  @if ($errors->any())
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                      @endforeach
                
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    @endif
                      <form class="forms-sample" action="{{url('admin/update-vendor-details/bank')}}" method="post" enctype="multipart/form-data" >@csrf
                      
                        <div class="form-group">
                          <label >Vendor Username/Email</label>
                          <input class="form-control" value="{{Auth::guard('admin')->user()->email}}" readonly="">
                        
                    
                        </div>
                        <div class="form-group">
                          <label for="account_holder_name">Account Holder Name</label>
                          <input type="text" class="form-control" id="account_holder_name" placeholder="Enter Account Holder Name" name="account_holder_name"@if(isset($vendorDetails['account_holder_name'])) value="{{$vendorDetails['account_holder_name']}}" @endif required="">
                        </div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" placeholder="Enter Bank Name" name="bank_name"@if(isset($vendorDetails['bank_name']))value="{{$vendorDetails['bank_name']}}"@endif  required="" >
                          </div>
                        <div class="form-group">
                          <label for="account_number">Account Number</label>
                          <input type="text" class="form-control" id="account_number" placeholder="Enter Account Number" name="account_number"@if(isset($vendorDetails['account_number']))value="{{$vendorDetails['account_number']}}"@endif  required="" >
                        </div>
                      
                        <div class="form-check form-check-flat form-check-primary">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
              
            @endif
           
           
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
  </div>

@endsection