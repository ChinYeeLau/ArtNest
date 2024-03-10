<?php use App\Models\Product; ?>

@extends('front.layout.layout')
@section('content')


        <!-- Single Product Start -->
    
            <div class="container py-5 h-100">
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row justify-content-center ">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row mt-5 ">
                            <a href="{{ url()->previous() }}"><p>Back</p></a>
                            <div class="col-lg-6">
                              
                                <div class="border rounded ">
                                    <div class="images p-3 ">
                                        <div class="text-center p-4 easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                            <a href="{{ asset('front/images/product_images/large/'.$productDetails['product_image']) }}">
                                                <img id="main-image" src="{{ asset('front/images/product_images/large/'.$productDetails['product_image']) }}" width="250" height="250" />
                                            </a>
                                           
                                        </div>
                                       <div  class="thumbnails">
                                        <a href="{{ asset('front/images/product_images/large/'.$productDetails['product_image']) }}" data-standard="{{ asset('front/images/product_images/small/'.$productDetails['product_image']) }}">
                                            <img src="{{ asset('front/images/product_images/small/'.$productDetails['product_image']) }}" alt="" width="60" height="60" />
                                        </a>
                                       
                                        @foreach($productDetails['images'] as $image)
                                        <a href="{{ asset('front/images/product_images/large/'.$image['image']) }}" data-standard="{{ asset('front/images/product_images/small/'.$image['image']) }}">
                                            <img src="{{ asset('front/images/product_images/small/'.$image['image']) }}" alt="" width="60" height="60" />
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                </div>
                                </div>
                          
                            <div class="col-lg-6 ">
                                <h4 class="fw-bold mb-3">{{$productDetails['product_name']}}</h4>
                              <div aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                        @if(isset($categoryDetails['categoryDetails']['section']['name']))
                                        <li class="breadcrumb-item"><a href="javascript:;">{{$categoryDetails['categoryDetails']['section']['name']}}</a></li>
                                    @endif
                                      <?php echo $categoryDetails['breadcrumbs']; ?>
                                    </ol>
                                  </div>
                                  
                                <p class="mb-4">{{$productDetails['description']}}</p>
                                  <?php $getDiscountPrice=Product::getDiscountPrice($productDetails['id']);?>
                                 <span class="getAttributePrice">
                                  @if($getDiscountPrice>0)
                                <h4 class="text-dark fs-5 fw-bold mb-0 product-discount-price">RM{{$getDiscountPrice}}</h4>
                                <span>Original Price:</span>
                                <span class="text-dark product-price">RM{{$productDetails['product_price']}}</span>
                                @else
                                <h5 class="text-dark fs-5 fw-bold mb-0 product-discount-price">RM{{$productDetails['product_price']}}</h5>
                                @endif
                            </span>
                                <br><br>
                                <h5>SKU onformation:</h5>
                               <div>
                                <span>Product Code:</span>
                                <span>{{$productDetails['product_code']}}</span>
                               </div>
                               <div>
                                <span>Product Color:</span>
                                <span>{{$productDetails['product_color']}}</span>
                               </div>
                               <div>
                                <span>Availability:</span>
                                @if ($totalStock>0)
                                <span style="color:green">In stock</span>
                                @else
                                <span class="red-text">Out of Stock</span>
                                @endif
                               </div>
                               <div>
                                @if ($totalStock>0)
                                <span>Only:</span>
                                <span>{{$totalStock}}left</span>
                                @endif
                               </div>
                               <br>
                               <div>
                                <span>Available Sizes:</span>
                              <select name="size" id="getPrice" product-id="{{ $productDetails['id'] }}">
                     <option value="">Select Size</option>
                         @foreach($productDetails['attributes'] as $attribute)
                      <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
                           @endforeach
                           </select>
                            </div>
                            <br>
                              <!--  <div class="d-flex mb-4">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>-->
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                            <div class="col-lg-12">
                             <h1>Reviews</h1>
                               
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                        <div class="d-flex">
                                            <img src="" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>Jason Smith</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic 
                                                    words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>Sam Peters</h5>
                                                    <div class="d-flex mb-3">
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star text-secondary"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic 
                                                    words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div>
                                </div>
                            </div>
                            <form action="#">
                                <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="text" class="form-control border-0 me-4" placeholder="Yur Name *">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="email" class="form-control border-0" placeholder="Your Email *">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Please rate:</p>
                                                <div class="d-flex align-items-center" style="font-size: 12px;">
                                                    <i class="fa fa-star text-muted"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <a href="#" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>
</div>
        <!-- Single Product End -->






@endsection