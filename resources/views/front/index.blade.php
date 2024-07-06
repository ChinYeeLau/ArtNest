<?php use App\Models\Product; ?>

@extends('front.layout.layout')
@section('content')

    
   <!-- Hero Start 
 
   <div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
              Banner Section Start-->
              <div class="col-lg-12" style=" position: relative;">
               
                
                    @if(isset($fixBanners[3]['image']))
                        <div class="container-fluid col-lg-12 pad" style=" background-image: url('{{ asset('front/images/banner_images/'.$fixBanners[3]['image']) }}');  background-size: cover;background-position: center; background-repeat: no-repeat;">
                            <div class="text-overlay col-lg-12" style="padding-top:100px;padding-bottom:100px;"> <!-- Adjust padding as needed -->
                                <h1 class="display-3" style="text-align: center; font-weight: 600; align-items: center;padding-bottom:30px;">Entrepreneurial Spirit For A Brighter Future</h1>
                                <p class="text-dark bannerdescription text-center">
                                    Where Malaysian designers flourish, connecting talent with opportunities, 
                                    boosting our economy in line with NEP 2030 goals.
                                </p>
                                 <a href="shop.html" class="banner-btn rounded-pill text-white ml-2" style="background-color: #f26b4e;  display:flex; align-items: center; justify-content: center; margin: auto;">SHOP NOW</a>
                            </div>
                        </div>
                    @endif
                
            </div>

     <!-- Fruits Shop Start-->
   <div class="container">
                    <div class="col-lg-12">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-12" style="margin-top:50px;">
                        <h1>Products</h1>
                    </div>
                    <div class="col-lg-12">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5 justify-content-center">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active tab-link" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark">New Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill tab-link" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark">Best Seller</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill tab-link" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark">Discounted Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill tab-link" data-bs-toggle="pill" href="#tab-4">
                                    <span class="text-dark">Featured Products</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @foreach($newProducts as $product)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        
                                          <?php $product_image_path='front/images/product_images/small/'.$product['product_image'];?>
                                        <div class="rounded position-relative fruite-item">
                                            <a href="{{url('product/'.$product['id'])}}" class="fruite-img">
                                                @if(!empty($product['product_image'])&&file_exists($product_image_path))
                                                <img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt="">
                                            @else
                                            <img src="{{asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt="">
    
                                            @endif
                                            </a>
                                           <!-- <div class="text-white px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px; background-color: #f26b4e;">New Products</div>-->
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{$product['product_name']}}</h4>
                                                <h6>{{$product['product_code']}}</h6>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
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
                                    </div>
                                    @endforeach  
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                            <div id="tab-2" class="tab-pane fade show p-0 ">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="row g-4">
                                            @foreach($bestSellers as $product)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                
                                                  <?php $product_image_path='front/images/product_images/small/'.$product['product_image'];?>
                                                <div class="rounded position-relative fruite-item">
                                                    <a href="{{url('product/'.$product['id'])}}" class="fruite-img">
                                                        @if(!empty($product['product_image'])&&file_exists($product_image_path))
                                                        <img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt="">
                                                    @else
                                                    <img src="{{asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt="">
                        
                                                    @endif
                                                    </a>
                                                   <!--  <div class="text-white px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px; background-color: #f26b4e;">Best Seller</div>-->
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4>{{$product['product_name']}}</h4>
                                                        <h6>{{$product['product_code']}}</h6>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <?php $getDiscountPrice=Product::getDiscountPrice($product['id']);?>
                                                            @if($getDiscountPrice>0)
                                                            <p class="text-dark fs-5 fw-bold mb-0 product-price">RM{{$product['product_price']}}</p>
                                                            <p class="text-red fs-5 fw-bold mb-0 product-discount-price" style="color:red;">RM{{$getDiscountPrice}}</p>
                                                            @else 
                                                            <p class="text-dark fs-5 fw-bold mb-0">{{$product['product_price']}}</p>
                                                           
                                                            @endif
                                                          
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div id="tab-3" class="tab-pane fade show p-0 ">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach($discountedProducts as $product)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            
                                              <?php $product_image_path='front/images/product_images/small/'.$product['product_image'];?>
                                            <div class="rounded position-relative fruite-item">
                                                <a href="{{url('product/'.$product['id'])}}" class="fruite-img">
                                                    @if(!empty($product['product_image'])&&file_exists($product_image_path))
                                                    <img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt="">
                                                @else
                                                <img src="{{asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt="">
                        
                                                @endif
                                                </a>
                                                <!-- <div class="text-white px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px; background-color: #f26b4e;">Discounted Products</div>-->
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{$product['product_name']}}</h4>
                                                    <h6>{{$product['product_code']}}</h6>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <?php $getDiscountPrice=Product::getDiscountPrice($product['id']);?>
                                                        @if($getDiscountPrice>0)
                                                        <p class="text-dark fs-5 fw-bold mb-0 product-price">RM{{$product['product_price']}}</p>
                                                        <p class="text-red fs-5 fw-bold mb-0 product-discount-price" style="color:red;">RM{{$getDiscountPrice}}</p>
                                                        @else 
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{$product['product_price']}}</p>
                                                       
                                                        @endif
                                                        
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane fade show p-0 ">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach($featuredProducts as $product)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            
                                              <?php $product_image_path='front/images/product_images/small/'.$product['product_image'];?>
                                            <div class="rounded position-relative fruite-item">
                                                <a href="{{url('product/'.$product['id'])}}" class="fruite-img">
                                                    @if(!empty($product['product_image'])&&file_exists($product_image_path))
                                                    <img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt="">
                                                @else
                                                <img src="{{asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt="">
                        
                                                @endif
                                                </a>
                                               <!--  <div class="text-white px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px; background-color: #f26b4e;">Featured Products</div>-->
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{$product['product_name']}}</h4>
                                                 <h6>{{$product['product_code']}}</h6>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <?php $getDiscountPrice=Product::getDiscountPrice($product['id']);?>
                                                        @if($getDiscountPrice>0)
                                                        <p class="text-dark fs-5 fw-bold mb-0 product-price">RM{{$product['product_price']}}</p>
                                                        <p class="text-red fs-5 fw-bold mb-0 product-discount-price" style="color:red;">RM{{$getDiscountPrice}}</p>
                                                        @else 
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{$product['product_price']}}</p>
                                                       
                                                        @endif
                                                      
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
         
    
                          <!-- Carousel Banner Start-->
                          <div class="container" style="margin-top:150px ;margin-bottom:150px">
                            <div class="col-lg-12">
                   
                        <div class="row g-4 ">
                          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($sliderBanners as $sliderBanner)
                                @if ($sliderBanner['status'] == 1)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <a @if (!empty($sliderBanner['link'])) href="{{ url($sliderBanner['link']) }}" @else href="javascript:;" @endif>
                                            <img title="{{ $sliderBanner['title'] }}" src="{{ asset('front/images/banner_images/'.$sliderBanner['image']) }}" alt="{{ $sliderBanner['alt'] }}">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                             
                             
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                        </div>
                    
                </div>
            </div>
        
        <!-- Carousel Banner End-->


            <!-- Banner Section End 
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($sliderBanners as $sliderBanner)
                    @if ($sliderBanner['status'] == 1)
                        <div class="carousel-item @if($loop->first) active @endif">
                            <a @if (!empty($sliderBanner['link'])) href="{{ url($sliderBanner['link']) }}" @else href="javascript:;" @endif>
                                <img title="{{ $sliderBanner['title'] }}" src="{{ asset('front/images/banner_images/'.$sliderBanner['image']) }}" alt="{{ $sliderBanner['alt'] }}">
                            </a>
                        </div>
                    @endif
                @endforeach
                 
                 
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
        </div>
        </div> 
    
 Hero End 
@if(isset($fixBanners[0]['image']))
<div class="container">
    <a href="{{ url($fixBanners[0]['link']) }}">
        <img class="img-fluid" title="{{ $fixBanners[0]['title'] }}" src="{{ asset('front/images/banner_images/'.$fixBanners[0]['image']) }}" alt="{{ $fixBanners[0]['alt'] }}">
    </a>
</div>
@endif
@if(isset($fixBanners[1]['image']))
<div class="container">
    <a href="{{ url($fixBanners[1]['link']) }}">
        <img class="img-fluid" title="{{ $fixBanners[1]['title'] }}" src="{{ asset('front/images/banner_images/'.$fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}">
    </a>
</div>
@endif

 
@endsection