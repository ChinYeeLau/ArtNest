<?php use App\Models\Product; ?>
<div class="row g-4 justify-content-center">
    @foreach($categoryProducts as $product)
    <div class="col-md-6 col-lg-6 col-xl-4">
        <!-- Product Card -->
        <div class="rounded position-relative fruite-item"> 
            <div >
                <!-- Product Image -->
                <?php $product_image_path='front/images/product_images/small/'.$product['product_image']; ?>
                @if(!empty($product['product_image']) && file_exists($product_image_path))
                <a href="{{url('product/'.$product['id'])}}"><img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt=""></a>
                @else
                <a href="{{url('product/'.$product['id'])}}"><img src="{{ asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt=""></a>
                @endif
            </div>
            <div class="p-4 border border-secondary border-top-0 rounded-bottom" >
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
@if(!isset($_REQUEST['search']))

@if (isset($_GET['sort']))
<div>{{$categoryProducts->appends(['sort'=>$_GET['sort']])->links()}}</div>
@else
<div>{{$categoryProducts->links()}}</div>
@endif
@endif