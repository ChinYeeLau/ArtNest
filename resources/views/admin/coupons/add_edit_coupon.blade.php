@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h4 class="font-weight-bold">Coupons</h4>
                    </div>
                    
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  <h4 class="card-title">{{$title}}</h4>
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
                
                  <form class="forms-sample" @if(empty($coupon['id'])) action="{{url('admin/add-edit-coupon')}}" @else action="{{url('admin/add-edit-coupon/'.$coupon['id'])}}"  @endif method="post" enctype="multipart/form-data" >@csrf
                  @if(empty($coupon['coupon_code']))
                  
                    <div class="form-group">
                        <label for="coupon_option"  >Coupon Option</label><br>
                        <span><input type="radio" name="coupon_option" id="AutomaticCoupon" value="Automatic" checked="">Automatic</span>
                        <span><input type="radio" name="coupon_option" id="ManualCoupon" value="Manual" >Manual</span>

                    </div>
                     
                    <div class="form-group" style="display:none;" id="couponField">
                        <label for="coupon_code"  >Coupon Code</label>
                        <input type="text"  class="form-control" name="coupon_code"  placeholder="Enter Coupon Code">
                    </div>
                    @else
                    <input type="hidden" name="coupon_option" value="{{$coupon['coupon_option']}}">
                    <input type="hidden" name="coupon_code" value="{{$coupon['coupon_code']}}">
                    <div class="form-group">
                        <label for="coupon_code">Coupon Code:</label>
                        <span>{{$coupon['coupon_code']}}</span>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="coupon_type"  >Coupon Type</label><br>
                        <span>
                            <input type="radio" name="coupon_type" value="Multiple Times" @switch($coupon['coupon_type']) @case('Multiple Times') checked  @endswitch  > Multiple Times
                        </span>
                        <span>
                            <input type="radio" name="coupon_type" value="Single Time" @switch($coupon['coupon_type'])   @case('Single Time')   checked  @endswitch> Single Time
                        </span>

                    </div>
                    <div class="form-group">
                        <label for="amount_type"  >Amount Type</label><br>
                        <span><input type="radio" name="amount_type"  value="Percentage"@switch($coupon['amount_type'])   @case('Percentage')   checked  @endswitch style="margin-right: 5px;">Percentage (%)</span>
                        <span><input type="radio" name="amount_type"  value="Fixed" @switch($coupon['amount_type'])   @case('Fixed')   checked  @endswitch style="margin-right: 5px;">Fixed (RM)</span>

                    </div>
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input type="text" name="amount" id="amount" class="form-control" 
                      @if(!empty($coupon['amount'])) value="{{ $coupon['amount']}}"@else value="{{old('amount')}}" @endif>
                  </div>
                      
                    <div class="form-group">
                        <label for="categories"  >Select Category</label>
                        <select name="categories[]"  class="form-control text-dark" multiple="" >
                          <option value="">Select</option>
                          @foreach($categories as $section)
                              <optgroup label="{{$section['name']}}"></optgroup>
                                  @foreach($section['categories'] as $category)
                                      <option value="{{$category['id']}}" @if(in_array($category['id'],$selCats)) selected=""@endif>{{$category['category_name']}}</option>
                                  @endforeach
                              
                          @endforeach
          
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="users"  >Select Users</label>
                        <select name="users[]"  class="form-control text-dark" multiple="" >
                            @foreach($users as $user)
                                      <option value="{{$user['email']}}" @if(in_array($user['email'],$selUsers)) selected=""@endif>{{$user['email']}}</option>
                                  @endforeach

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="expiry_date" > Expiry Date</label>
                        <input  type="date" name="expiry_date" id="expiry_date" class="form-control" placeholder="Enter Expiry Date" rows="3" @if(isset($coupon['expiry_date'])) value="{{$coupon['expiry_date']}}" @else value="{{old ('expiry_date')}}" @endif></input>
                      </div>
               
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  
                  </form>
                   
                </div>
              </div>
            </div>
          </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <!-- partial -->
  </div>
</div>
@include('admin.layout.footer')

@endsection