<?php use App\Models\Product; ?>

<div class="row">
    <div class="container-fluid  " 
    style="background-image: url('{{ asset('front/img/sellonArtNest_banner3.png') }}');  background-size: cover;  background-position: center; background-repeat: no-repeat; padding: 50px 0;margin:0px 0px">
        
    <div class="row justify-content-center  ">
        <div class="col-12 col-md-8 d-flex align-items-center flex-column flex-md-row text-center text-md-start justify-content-center">
           
                @if($vendor)
                    @if(!empty(Auth::guard('admin')->user()->image))
                        <img src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}" 
                             class="profile-img"
                             alt="Admin Photo">
                        <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                    @else
                        <img src="{{ url('admin/images/photos/no-image.png') }}" 
                             class="profile-img"
                             alt="No Image">
                    @endif
                @endif
            <div class="profile-info ms-md-4">
                <h1>{{$getVendorShop}}</h1>
                <p><strong>Name:</strong> {{$vendor->name}}</p>
                <p><strong>State:</strong> {{$vendor->state}}</p>
                <p><strong>Status:</strong> {{$vendor->current_status}}</p>
                @if(!empty($vendor['portfolio']))
                    <p><strong>Portfolio:</strong> <a href="{{ url($vendor->portfolio) }}">{{ $vendor->portfolio }}</a></p>
                @endif
                <a href="{{url('/user/chat')}}" 
                       class=" text-white ml-2" 
                       style="background-image: linear-gradient(to right, #f8a239, #f26b4e); box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.1); 
                              width: 150px; 
                               height: 47px; 
                              border-radius: 10px; 
                              font-size: 20px; 
                              font-weight: 600; 
                              text-align: center; 
                              display: inline-flex; 
                              align-items: center; 
                              justify-content: center; 
                              margin: auto;">
                       Chat Now
                    </a>
            </div>
        </div>
    </div>   
</div>
</div>

<div class="row justify-content-center" style="text-align: center;">
    <div class="col-md-6 col-lg-6 col-xl-4">
        <br><br>
    <h1>Products</h1>
    <br>
</div>
</div>
<div class="container">
    <div class="row">
        @foreach($vendorProducts as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <?php $product_image_path='front/images/product_images/small/'.$product['product_image'];?>
            <div class="rounded position-relative fruite-item">
                <a href="{{url('product/'.$product['id'])}}" class="fruite-img">
                    @if(!empty($product['product_image']) && file_exists($product_image_path))
                    <img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt="">
                    @else
                    <img src="{{asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt="">
                    @endif
                </a>
                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4 class="fs-sm fs-md-4 fs-lg-5">{{$product['product_name']}}</h4>
                    <h6 class="fs-xs fs-md-3 fs-lg-4">{{$product['product_code']}}</h6>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                        <?php $getDiscountPrice=Product::getDiscountPrice($product['id']);?>
                        @if($getDiscountPrice > 0)
                        <p class="text-dark fs-5 fw-bold mb-0 product-price">RM{{$product['product_price']}}</p>
                        <p class="text-red fs-5 fw-bold mb-0 product-discount-price" style="color:red;">RM{{$getDiscountPrice}}</p>
                        @else 
                        <p class="text-dark fs-5 fw-bold mb-0">{{$product['product_price']}}</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Check if Product is New -->
            <?php $isProductNew=Product::isProductNew($product['id']); ?>
            @if($isProductNew == "Yes")
            <div class="tag new">
                <span></span>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@if(isset($_GET['sort']))
<div>{{$vendorProducts->appends(['sort'=>$_GET['sort']])->link()}}</div>
@else
<div>{{$vendorProducts->links()}}</div>
@endif
</div>
