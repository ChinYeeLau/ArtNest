<?php use App\Models\Product; 
use App\Models\Section;?>
@extends('front.layout.layout')
@section('content')


        <!-- Single Product Start -->
    
            <div class="container py-5 h-100">
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row justify-content-center ">
                    <div class="col-lg-8 col-xl-9">
                        <div class="col-12 text-start">
                            <a href="javascript:history.back()">&lt; Back</a>
                        </div>
                        <div class="row mt-5 ">
                            <div class="col-lg-6">
                                <div class="border rounded ">
                                    <div class="images p-3">
                                        <div class="text-center p-4 easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                            @php
                                                $mainImage = !empty($productDetails['product_image']) ? 'front/images/product_images/large/'.$productDetails['product_image'] : 'front/images/product_images/small/no-image.png';
                                            @endphp
                                            <a href="{{ asset($mainImage) }}">
                                                <img id="main-image" src="{{ asset($mainImage) }}" width="250" height="250" />
                                            </a>
                                        </div>
                                        <div class="thumbnails">
                                            @php
                                                $thumbnailImage = !empty($productDetails['product_image']) ? 'front/images/product_images/small/'.$productDetails['product_image'] : 'front/images/product_images/small/no-image.png';
                                            @endphp
                                            <a href="{{ asset($mainImage) }}" data-standard="{{ asset($thumbnailImage) }}">
                                                <img src="{{ asset($thumbnailImage) }}" alt="item-image" width="60" height="60" />
                                            </a>
                                    
                                            @foreach($productDetails['images'] as $image)
                                                @php
                                                    $thumbImage = !empty($image['image']) ? 'front/images/product_images/small/'.$image['image'] : 'front/images/product_images/small/no-image.png';
                                                @endphp
                                                <a href="{{ asset('front/images/product_images/large/'.$image['image']) }}" data-standard="{{ asset($thumbImage) }}">
                                                    <img src="{{ asset($thumbImage) }}" alt="item-image" width="60" height="60" />
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                </div>
                          
                            <div class="col-lg-6 ">
                            <div>
                                @if(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong>Error</strong> <?php echo Session::get('error_message'); ?>
                                  <button type="button" class="close close-button" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                @endif
                                @if(Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <strong>Success</strong>  <?php echo Session::get('success_message'); ?>
                                  <button type="button" class="close close-button" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                @endif
                            </div>
                            <div class="d-flex">
                                <h4 class="fw-bold mb-3">{{$productDetails['product_name']}}</h4>
                                <div class="d-flex " style="color:gold; font-size:17px;" title="{{$avgRating}}out of 5-based on {{count($ratings)}} Reviews ">
                                    @if($avgStarRating > 0)
                               @for($star = 1; $star <= $avgStarRating; $star++)
                                <span>&#9733;</span>
                                  @endfor
                                 @endif
                                <h6 class="mx-2">({{($avgRating)}})</h6>
                            </div>
                            </div>
                              <div aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                                        @if(isset($categoryDetails['categoryDetails']['section']['name']))
                                        <li class="breadcrumb-item"><a>{{$categoryDetails['categoryDetails']['section']['name']}}</a></li>
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
                               <div class="d-column ">
                                  <div>
                               <form action="{{url('cart/add')}}" method="Post" >@csrf
                                <input type="hidden" name="product_id" value={{$productDetails['id']}}>
                               <div>
                                <span>Available Variable:</span>
                              <select name="size" id="getPrice" product-id="{{ $productDetails['id'] }}" required="">
                     <option value="">Select Variable</option>
                         @foreach($productDetails['attributes'] as $attribute)
                      <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}</option>
                           @endforeach
                           </select>
                            </div>
                            <br>
                            <span>Sold by:</span>
                            <div  >
                                <a href="/products/{{$productDetails['vendor']['id']?? ''}}">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                <img style="border-radius: 50%; width:50px; height:50px;" src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}" alt="Admin/Vendor Image">
                            @else
                                <img style="border-radius: 50%; width:50px; height:50px;" src="{{ url('admin/images/photos/no-image.png') }}" alt="No Image">
                            @endif
                                @if(isset($productDetails['vendor']))
                                <span>{{$productDetails['vendor']['vendorbusinessdetails']['shop_name']}}</span>
                                @endif
                            </a>
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
                                    <input type="text" name="quantity" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                                <div class="d-flex ">
                                <button class="btn3 px-4 py-2 mb-4 " type="submit">Add to cart</button>
                            
                        </form>
                        <form action="{{ url('wishlist/add-remove') }}" method="post" id="wishlist-form" class="px-4"> @csrf
                  
                            <input type="hidden" name="product_id" value="{{ request()->route('id') }}">
                            <button type="submit" class="btn3  px-4 py-2 mb-4">
                                <div class="heart-icon">
                                    @if($inWishlist)
                                    <i class="fa fa-heart  "></i>
                                    @else
                                    <i class="fa-regular fa-heart"></i>
                                  @endif

                                    </div>
                            </button>
                        </div>
                        </div>
                        </form>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between" style="max-width:250px">
                                <div>Five Stars</div>
                                <div> &#9733;  &#9733; &#9733; &#9733; &#9733;</div>
                                <div>({{$ratingFiveStarCount}})</div>
                            </div>
                            <div class="d-flex justify-content-between" style="max-width:250px">
                                <div>Four Stars</div>
                                <div style="padding-right:3px"> &#9733;  &#9733; &#9733; &#9733; &#9733;</div>
                                <div>({{$ratingFourStarCount}})</div>
                            </div>
                            <div class="d-flex justify-content-between" style="max-width:250px">
                                <div>Three Stars</div>
                                <div style="padding-right:12px"> &#9733;  &#9733; &#9733; &#9733; &#9733;</div>
                                <div>({{$ratingThreeStarCount}})</div>
                            </div>
                            <div class="d-flex justify-content-between" style="max-width:250px">
                                <div>Two Stars</div>
                                <div > &#9733;  &#9733; &#9733; &#9733; &#9733;</div>
                                <div>({{$ratingTwoStarCount}})</div>
                            </div>
                            <div class="d-flex justify-content-between" style="max-width:250px">
                                <div>One Stars</div>
                                <div > &#9733;  &#9733; &#9733; &#9733; &#9733;</div>
                                <div>({{$ratingOneStarCount}})</div>
                            </div>                                   
                                </div>
                            <div class="col-lg-12 ">
                                <form action="{{url('add-rating')}}" method="POST" name="formRating" id="formRating">@csrf
                                    <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                                    <br><h4 class="fw-bold">Leave a Review</h4>
                                    <div >
                                          <div class="d-flex">
                                                    <p >Please rate:</p>
                                                    <div class="rate">
                                                        <input style="display:none;" type="radio" id="star5" name="rating" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input style="display:none;" type="radio" id="star4" name="rating" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input style="display:none;" type="radio" id="star3" name="rating" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input style="display:none;" type="radio" id="star2" name="rating" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input style="display:none;" type="radio" id="star1" name="rating" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                      </div>
                                                </div>
                                       
                                       
                                        <div class="col-lg-12">
                                            <div class="border-bottom rounded my-4">
                                                <textarea name="review" id="review" class="form-control border-0" cols="30" rows="4" placeholder="Your Review *" spellcheck="false" required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-end py-3 mb-5">
                                              
                                                <button type="submit" class="btn3  px-4 py-3" style="margin:0px;"> Post Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                             <h1>Reviews({{count($ratings)}})</h1>
                               
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                       @if(count($ratings)>0)
                                         @foreach($ratings as $rating)
                                        <div class="d-flex">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">{{date("d-m-Y H:i:s",strtotime($rating['created_at']))}}</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>{{$rating['user']['name']}}</h5>
                                                    <div class="rate">
                                                   <?php
                                                   $count=0;
                                                   while($count<$rating['rating']){
                                                   ?>
                                                   <span style="color:gold;"> &#9733;</span>
                                                   <?php $count++;} ?>
                                                </div>
                                                </div>
                                                <p>{{$rating['review']}} </p>
                                            </div>
                                        </div>
                                        @endforeach
                                       @endif
                                    </div>
                                 
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>
</div>
        <!-- Single Product End -->






@endsection