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
                        <input type="text" class="form-control" id="vendor_name" placeholder="Enter Name" name="vendor_name" @if(isset($vendorDetails['name']))value="{{$vendorDetails['name']}}" @endif required="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_state">State</label>
                        <select class="form-control" id="vendor_state" name="vendor_state" required="">
                            <option value="">Select State</option>
                            <option value="Johor" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Johor') selected @endif>Johor</option>
                            <option value="Kedah" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Kedah') selected @endif>Kedah</option>
                            <option value="Kelantan" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Kelantan') selected @endif>Kelantan</option>
                            <option value="Melaka" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Melaka') selected @endif>Melaka</option>
                            <option value="Negeri Sembilan" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Negeri Sembilan') selected @endif>Negeri Sembilan</option>
                            <option value="Pahang" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Pahang') selected @endif>Pahang</option>
                            <option value="Perak" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Perak') selected @endif>Perak</option>
                            <option value="Perlis" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Perlis') selected @endif>Perlis</option>
                            <option value="Pulau Pinang" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Pulau Pinang') selected @endif>Pulau Pinang</option>
                            <option value="Sabah" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Sabah') selected @endif>Sabah</option>
                            <option value="Sarawak" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Sarawak') selected @endif>Sarawak</option>
                            <option value="Selangor" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Selangor') selected @endif>Selangor</option>
                            <option value="Terengganu" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Terengganu') selected @endif>Terengganu</option>
                            <option value="Kuala Lumpur" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Kuala Lumpur') selected @endif>Kuala Lumpur</option>
                            <option value="Labuan" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Labuan') selected @endif>Labuan</option>
                            <option value="Putrajaya" @if(isset($vendorDetails['state']) && $vendorDetails['state'] == 'Putrajaya') selected @endif>Putrajaya</option>
                        </select>
                    </div>
                      <div class="form-group">
                        <label for="vendor_mobile">Mobile</label>
                        <input type="text" class="form-control" id="vendor_mobile" placeholder="Enter 10 Digit Mobile Number" name="vendor_mobile"  @if(isset($vendorDetails['mobile']))value="{{$vendorDetails['mobile']}}" @endif  required="" maxlength="10"minlength="10">
                      </div>
                      <div class="form-group">
                        <label for="vendor_current_status">Current Status</label>
                        <input type="text" class="form-control" id="vendor_current_status" placeholder="Are you looking for job or a freelancer?" name="vendor_current_status"  @if(isset($vendorDetails['current_status']))value="{{$vendorDetails['current_status']}}" @endif required="" >
                      </div>
                      <div class="form-group">
                        <label for="vendor_portfolio">Portfolio</label>
                        <input type="text" class="form-control" id="vendor_portfolio" placeholder="portfolio link" name="vendor_portfolio"  @if(isset($vendorDetails['portfolio']))value="{{$vendorDetails['portfolio']}}" @endif >
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
                            <select class="form-control" id="shop_state" name="shop_state" required="">
                                <option value="">Select State</option>
                                <option value="Johor" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Johor') selected @endif>Johor</option>
                                <option value="Kedah" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Kedah') selected @endif>Kedah</option>
                                <option value="Kelantan" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Kelantan') selected @endif>Kelantan</option>
                                <option value="Melaka" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Melaka') selected @endif>Melaka</option>
                                <option value="Negeri Sembilan" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Negeri Sembilan') selected @endif>Negeri Sembilan</option>
                                <option value="Pahang" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Pahang') selected @endif>Pahang</option>
                                <option value="Perak" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Perak') selected @endif>Perak</option>
                                <option value="Perlis" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Perlis') selected @endif>Perlis</option>
                                <option value="Pulau Pinang" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Pulau Pinang') selected @endif>Pulau Pinang</option>
                                <option value="Sabah" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Sabah') selected @endif>Sabah</option>
                                <option value="Sarawak" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Sarawak') selected @endif>Sarawak</option>
                                <option value="Selangor" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Selangor') selected @endif>Selangor</option>
                                <option value="Terengganu" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Terengganu') selected @endif>Terengganu</option>
                                <option value="Kuala Lumpur" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Kuala Lumpur') selected @endif>Kuala Lumpur</option>
                                <option value="Labuan" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Labuan') selected @endif>Labuan</option>
                                <option value="Putrajaya" @if(isset($vendorDetails['shop_state']) && $vendorDetails['shop_state'] == 'Putrajaya') selected @endif>Putrajaya</option>
                            </select>
                        </div>
                          <div class="form-group">
                            <label for="shop_mobile">Shop Mobile</label>
                            <input type="text" class="form-control" id="shop_mobile" placeholder="Enter 10 Digit Mobile Number" name="shop_mobile"@if(isset($vendorDetails['shop_mobile']))value="{{$vendorDetails['shop_mobile']}}"  @endif required="" maxlength="10"minlength="10">
                          </div>
                          <div class="form-group">
                            <label for="shop_website">Shop Website</label>
                            <input type="text" class="form-control" id="shop_website" placeholder="Any Website?If No,May Ignore." name="shop_website"@if(isset($vendorDetails['shop_website']))value="{{$vendorDetails['shop_website']}}" @endif >
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
                          <select class=" form-control" id="bank_name" name="bank_name" required="">
                              <option value="">Select Bank Name</option>
                              <option value="Affin Bank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Affin Bank') selected @endif>Affin Bank</option>
                              <option value="Agrobank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Agrobank') selected @endif>Agrobank</option>
                              <option value="Alliance Bank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Alliance Bank') selected @endif>Alliance Bank</option>
                              <option value="AmBank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'AmBank') selected @endif>AmBank</option>
                              <option value="CIMB" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'CIMB') selected @endif>CIMB</option>
                              <option value="Public Bank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Public Bank') selected @endif>Public Bank</option>
                              <option value="Maybank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Maybank') selected @endif>Maybank</option>
                              <option value="HSBC" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'HSBC') selected @endif>HSBC</option>
                              <option value="RHB Bank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'RHB Bank') selected @endif>RHB Bank</option>
                              <option value="Hong Leong Bank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Hong Leong Bank') selected @endif>Hong Leong Bank</option>
                              <option value="Standard Chartered Bank" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Standard Chartered Bank') selected @endif>Standard Chartered Bank</option>
                              <option value="Citibank Malaysia" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Citibank Malaysia') selected @endif>Citibank Malaysia</option>
                              <option value="Bank Islam Malaysia Berhad" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Bank Islam Malaysia Berhad') selected @endif>Bank Islam Malaysia Berhad</option>
                              <option value="Bank Muamalat Malaysia Berhad" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Bank Muamalat Malaysia Berhad') selected @endif>Bank Muamalat Malaysia Berhad</option>
                              <option value="Bank Rakyat" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Bank Rakyat') selected @endif>Bank Rakyat</option>
                              <option value="UOB Malaysia" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'UOB Malaysia') selected @endif>UOB Malaysia</option>
                              <option value="OCBC Bank Malaysia" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'OCBC Bank Malaysia') selected @endif>OCBC Bank Malaysia</option>
                              <option value="Affin Islamic Bank Berhad" @if(isset($vendorDetails['bank_name']) && $vendorDetails['bank_name'] == 'Affin Islamic Bank Berhad') selected @endif>Affin Islamic Bank Berhad</option>
                          </select>
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