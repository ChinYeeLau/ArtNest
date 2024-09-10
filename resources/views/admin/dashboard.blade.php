@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        @if(Auth::guard('admin')->user()->type == "vendor")
            <!-- Vendor View -->
            <div class="row">
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Products</p>
                                    <p class="fs-30 mb-2">{{ $productsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Orders</p>
                                    <p class="fs-30 mb-2">{{ $ordersCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4 stretch-card transparent">
                            @if(Auth::guard('admin')->user()->type == "vendor")
                            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                            @endif                      
                          </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                    <h4 class="font-weight-bold " style="padding-bottom:10px">New Products</h4>
                <div class="table-responsive border-top" >
                    <table  class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                              
                               
                                <th>
                                    Product 
                                 </th>
                                   <th>
                                   Status
                                     </th>
                                     <th>
                                       Actions
                                  </th>
                             </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                           
                            <tr>
                                <td>
                                    {{$product['id']}}
                                </td>
                              
                                <td>
                                    @if(!empty($product['product_image']))
                                    <img style="width:120px;height:120px;padding-right:10px" src="{{asset('front/images/product_images/small/'.$product['product_image'])}}">{{$product['product_name']}}
                                    ( @if(isset($product['category']['category_name']))
                                    {{$product['category']['category_name']}}
                                      @endif)
                                    @else
                                    <img style="width:120px;height:120px;padding-right:10px"  src="{{asset('front/images/product_images/small/no-image.png'.$product['product_image'])}}">{{$product['product_name']}}
                                    ( @if(isset($product['category']['category_name']))
                                    {{$product['category']['category_name']}}
                                      @endif)

                                @endif
                                </td>
                                <td>
                                    @if($product['status']==1)
                                    <a class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}" href="javascript:void(0)"><i style="font-size:25px"class="mdi mdi-bookmark-check" status="Active"></i></a>
                                    @else
                                    <a class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}" href="javascript:void(0)"><i style="font-size:25px" class="mdi mdi-bookmark-outline"status="Inactive"></i></a>
                                    @endif
                                </td>
                                <td>
                                   
                                    <a title="Edit Product"href="{{url('admin/add-edit-product/'.$product['id'])}}"><i  style="font-size:25px" class="mdi mdi-pencil-box"></i></a>
                                    <a title="Add Attributes" href="{{url('admin/add-edit-attributes/'.$product['id'])}}"><i  style="font-size:25px" class="mdi mdi-plus-box"></i></a>
                                    <a title="Add Multiple Images" href="{{url('admin/add-images/'.$product['id'])}}"><i  style="font-size:25px" class="mdi mdi-library-plus"></i></a>

                                    <?php /*<a title="product" class="confirmDelete"  href="{{url('admin/delete-product/'.$product['id'])}}" ><i style="font-size:25px" class="mdi mdi-file-excel-box"></i></a>*/ ?>
                                    <a href="javascript:void(0)" class="confirmDelete" module="product" moduleid="{{$product['id']}}"><i style="font-size:25px" class="mdi mdi-file-excel-box"></i></a>

                                </td>
                            </tr>
                          @endforeach
                      
                        </tbody>
                    </table>
                    <a href="{{url('admin/products')}}"><h6 style="text-align: right;color:blue">>More Products</h6></a>
                </div>
            </div>
            </div>
            <div class="row">
           
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-weight-bold ">Orders</h4>
                            <!--<p class="card-description">
                                Add class <code>.table-bordered</code>
                            </p>-->
                            <div class="table-responsive pt-3">
                                <table id="orders" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Order ID
                                            </th>
                                            <th>
                                                Order Date
                                            </th>
                                            <th>
                                                Customer Name
                                            </th>
                                            <th>
                                               Customer Email
                                            </th>
                                            <th>
                                               Ordered Products
                                            </th>
                                            <th>
                                                Order Amount
                                            </th>
                                            <th>
                                                Order Status
                                            </th>
                                            <th>
                                               Payment Method
                                            </th>
                                                 <th>
                                                   Actions
                                              </th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        @if ($order['orders_products'])
                                        <tr>
                                            <td>
                                                {{$order['id']}}
                                            </td>
                                            <td>
                                                {{ date('Y-m-d h:i:s', strtotime($order['created_at'])) }}
                                            </td>
                                            <td>
                                                {{$order['name']}}
                                            </td>
                                            <td>
                                                {{$order['email']}}
                                            </td>
                                            <td>
                                                @foreach($order['orders_products'] as $product)
                                              {{ $product['product_code'] }} ({{ $product['product_qty'] }} )<br>
                                              @endforeach
                                            </td>
                                            <td>
                                                {{$order['grand_total']}}
                                            </td>
                                            <td>
                                                {{$order['order_status']}}
                                            </td>
                                            <td>
                                                {{$order['payment_method']}}
                                            </td>
                                            <td>
                                                <a title="View Order Details" href="{{url('admin/orders/'.$order['id'])}}"><i style="font-size:25px" class="mdi mdi-file-document"></i></a>
                                                <a target="_blank" title="View Order Invoice" href="{{url('admin/orders/invoice/'.$order['id'])}}"><i style="font-size:25px" class="mdi mdi-printer"></i></a>
                                                <a target="_blank" title="Print PDF Invoice" href="{{url('admin/orders/invoice/pdf/'.$order['id'])}}"><i style="font-size:25px" class="mdi mdi-file-pdf"></i></a>
                                            </td>
                                          
                                           
                                        </tr>
                                        @endif
                                      @endforeach
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
            <div>
            </div>
    </div>
            @include('admin.layout.footer')

        @else
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Products</p>
                                <p class="fs-30 mb-2">{{ $productsCount }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Orders</p>
                                <p class="fs-30 mb-2">{{ $ordersCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Sections</p>
                                <p class="fs-30 mb-2">{{ $sectionsCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Categories</p>
                                <p class="fs-30 mb-2">{{ $categoriesCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Subscribers</p>
                                    <p class="fs-30 mb-2">{{ $subscribersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total Coupons</p>
                                    <p class="fs-30 mb-2">{{ $couponsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')

        @endif
        
    

    <!-- content-wrapper ends -->
   
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var yValues = @json($yValues); // Ensure this line correctly outputs yValues
        console.log('yValues:', yValues); // Debug output to check yValues
        var barColors = ["red", "green", "blue", "orange", "brown", "purple", "pink", "cyan", "lime", "indigo", "grey", "gold"];
    
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: "Monthly Sales"
                    }
                }
            }
        });
    });
    </script>
@endsection