<?php use App\Models\Product; ?>
@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success</strong> {{Session::get('success_message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Order Details</h3>
                      <h6 class="font-weight-normal mb-0"><a href ="{{url('admin/orders')}}">Back to Orders</a></h6>
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
       
              <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title"> Order Details</h4>
                    
           
                      <div class="form-group">
                        <label style="font-weight:500;">Order ID</label>
                        <label > #{{$orderDetails['id']}} </label>
                        <br>
                        <label style="font-weight:500;">Order Date</label>
                        <label >{{date('Y-m-d h:i:s',strtotime($orderDetails['created_at']));}}</label>
                       <br>
                        <label style="font-weight:500;">Order Status</label>
                        <label > {{$orderDetails['order_status']}} </label>
                        <br>
                        <label style="font-weight:500;">Order Total</label>
                        <label > RM {{$orderDetails['grand_total']}} </label>
                        <br>
                        <label style="font-weight:500;">Shipping Charges</label>
                        <label > RM {{$orderDetails['shipping_charges']}} </label>
                        <br>
                        @if(!empty($orderDetails['coupon_code']))
                        <label style="font-weight:500;">Coupon Code</label>
                        <label > {{$orderDetails['coupon_code']}} </label>
                        <br>
                        <label style="font-weight:500;">Coupon Amount</label>
                        <label > RM {{$orderDetails['coupon_amount']}} </label>
                        <br>
                        @endif
                        <label style="font-weight:500;">Payment Method</label>
                        <label > {{$orderDetails['payment_method']}} </label>
                        <br>
                        <label style="font-weight:500;">Payment Gateway</label>
                        <label > {{$orderDetails['payment_gateway']}} </label>
                    </div>
                </div>
              </div>
            </div>
             
           
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title">Customer Details</h4>
                    
                    <div class="form-group">
                        <label style="font-weight:500;">Name</label>
                        <label > {{$userDetails['name']}} </label>
                        <br>
                        @if(!empty($userDetails['address']))
                        <label style="font-weight:500;">Address</label>
                        <label > {{$userDetails['address']}} </label>
                        <br>
                        @endif
                        @if(!empty($userDetails['state']))
                        <label style="font-weight:500;">State</label>
                        <label > {{$userDetails['state']}} </label>
                        <br>
                        @endif
                        <label style="font-weight:500;">Mobile</label>
                        <label > {{$userDetails['mobile']}} </label>
                        <br>
                        <label style="font-weight:500;">Email</label>
                        <label > {{$userDetails['email']}} </label>
                        <br>
                    </div>
           
                  </div>
                    
                    
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title"> Delivery Address</h4>
                    
                    <div class="form-group">
                        <label style="font-weight:500;">Name</label>
                        <label > {{$orderDetails['name']}} </label>
                        <br>
                       
                        <label style="font-weight:500;">Address</label>
                        <label > {{$orderDetails['address']}} </label>
                        <br>
                        <label style="font-weight:500;">State</label>
                        <label > {{$orderDetails['state']}} </label>
                        <br>
                        <label style="font-weight:500;">PostCode</label>
                        <label > {{$orderDetails['postcode']}} </label>
                        <br>
                        <label style="font-weight:500;">Mobile</label>
                        <label > {{$orderDetails['mobile']}} </label>
                        <br>
                    </div>
                  </div>
                   
                  </div>
                </div>
           
            
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title"> Update Order Status</h4>
                    @if(Auth::guard('admin')->user()->type!="vendor")
                    <div class="form-group">                
           <form action="{{url('admin/update-order-status')}}" method="post">@csrf
        <input type="hidden" name="order_id" value="{{$orderDetails['id']}}">
        <select name="order_status" required="">
            <option value="">Select</option>
            @foreach ($orderStatuses as $status)
            <option value="{{$status['name']}}"@if (!empty ($orderDetails['order_status'])&& $orderDetails['order_status']==$status['name']) selected="" @endif>{{$status['name']}}</option>
            @endforeach
        </select> 
        <button type="submit">Update</button>
        </form>
        <br>
        @foreach($orderLog as $log)
        <strong>{{$log['order_status']}}</strong><br>
        {{date('Y-m-d h:i:s',strtotime($log['created_at']));}}<br>
        <hr>
        @endforeach
    </div> 
    @else
    This feature is restricted.
    @endif
                  </div>

                </div>
              </div>
            </div>
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      
                      <h4 class="card-title">Ordered Products</h4>
                      <div class="table-responsive">
                        <table class="table  ">
                            <thead>
                            <tr class="table-info">
                              <th>  Product Image</th>
                              <th>  Product Code </th>
                              <th>  Product Name  </th>
                              <th>  Product Size</th>
                              <th> Product Color </th>
                              <th> Product Quantity</th>
                              <th> Item Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orderDetails['orders_products'] as $product)
                          <tr>
                              <td> @php $getProductImage=Product::getProductImage($product['product_id'])@endphp 
                             <a href="{{url('product/'.$product['product_id'])}}"> <img style="width:80px;height:80px;border-radius:0px;" src="{{asset('front/images/product_images/small/'.$getProductImage)}}"></a>
                              </td>
                              <td >  {{$product['product_code']}} </td>
                              <td>   {{$product['product_name']}} </td>
                              <td>   {{$product['product_size']}}</td>
                              <td> {{$product['product_color']}} </td>
                              <td>  {{$product['product_qty']}}</td>
                              <td> 
                                <form action="{{url('admin/update-order-item-status')}}" method="post">@csrf
                                    <input type="hidden" name="order_item_id" value="{{$product['id']}}">
                                    <select name="order_item_status" required="">
                                        <option value="">Select</option>
                                        @foreach ($orderItemStatuses as $status)
                                        <option value="{{ $status['name'] }}" @if ($product['item_status'] == $status['name']) selected @endif>{{ $status['name'] }}</option>
                                        @endforeach
                                    </select> 
                                    <button type="submit">Update</button>
                                    </form>
                            </td>

                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                     
                    </div>
                  </div>
              </div>



            </div>
      
        </div>
      
  
            
           
           
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
  </div>

@endsection