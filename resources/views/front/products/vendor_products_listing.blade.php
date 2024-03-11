<?php use App\Models\Product; ?>

<div class="row justify-content-center"style="text-align: center;">
    <div style="text-align:center">
        <h1>{{$getVendorShop}}</h1>
         @if($vendor)
         @if(!empty(Auth::guard('admin')->user()->image))
    <img src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}" alt="Admin Photo">
    <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
@else
    <img src="{{ url('admin/images/photos/no-image.png') }}" alt="No Image">
@endif
        <p>{{$vendor->name}}</p>
        <p>{{$vendor->state}}</p>
        <p>{{$vendor->current_status}}</p>
        <a href="{{ url($vendor->portfolio) }}"><p>{{ $vendor->portfolio }}</p></a>
        <!-- Add more vendor personal details here if needed -->
    @endif
    </div>
    @foreach($vendorProducts as $product)
    <div class="col-md-6 col-lg-6 col-xl-4">
        <!-- Product Card -->
        <div class="rounded position-relative fruite-item"> 
            <div class="fruite-img" href="{{url('product/'.$product['id'])}}">
                <!-- Product Image -->
                <?php $product_image_path='front/images/product_images/small/'.$product['product_image']; ?>
                @if(!empty($product['product_image']) && file_exists($product_image_path))
                <img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt="">
                @else
                <img src="{{ asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt="">
                @endif
            </div>
            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                <!-- Product Details -->
                <h6>{{$product['product_code']}}</h6>
                <h4>
                    <a href="{{url('product/'.$product['id'])}}">{{$product['product_name']}}</a>
                </h4>
                <p>{{$product['description']}}</p>                                           
                <div class="d-flex justify-content-between flex-lg-wrap">
                    <!-- Product Prices -->
                    <?php $getDiscountPrice=Product::getDiscountPrice($product['id']);?>
                    @if($getDiscountPrice > 0)
                    <p class="red-text fs-5 fw-bold mb-0 product-price" >RM{{ $getDiscountPrice }}</p>
                    <p class="text-dark fs-5 fw-bold mb-0 product-discount-price" style=" text-decoration: line-through;">RM{{ $product['product_price'] }}</p>
                @else 
                    <p class="text-dark fs-5 fw-bold mb-0 product-price">RM{{ $product['product_price'] }}</p>
                @endif
                    <div>
                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to Wishlist</a>
                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>
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

@if(isset($_GET['sort']))
<div>{{$vendorProducts->appends(['sort'=>$_GET['sort']])->link()}}</div>
@else
<div>{{$vendorProducts->links()}}</div>
@endif
</div>
