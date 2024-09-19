   <?php 
   use App\Models\ProductsFilter;
   use App\Models\Category;
   use App\Models\Product;
   $productFilters=ProductsFilter::productFilters();
   
   ?>
   <!-- Fruits Shop Start-->
   <div class="row" style="margin-top: 80px;padding: 0px 0;">
    <div class="container-fluid col-lg-12 pad" 
    style="background-image: url('{{ asset('front/img/sellonArtNest_banner3.png') }}');  background-size: cover;  background-position: center; background-repeat: no-repeat; padding: 50px 0;">
        
        <div class="centered text-overlay">
            <div class="row mb-4 mt-4">
                <div class="col-12 text-center" >
                    <h1 class="mb-4 sellonArtNesttitle3">
                        <div aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center" style="margin-bottom:0px">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                @if(isset($categoryDetails['categoryDetails']['section']['name']))
                                    <li class="breadcrumb-item"><a href="#">{{ $categoryDetails['categoryDetails']['section']['name'] }}</a></li>
                                @endif
                                <?php echo $categoryDetails['breadcrumbs']; ?>
                            </ol>
                        </div>
                    </h1>
                </div>
            </div>  
        </div> 
    </div>
</div>
 

<div class="container-fluid fruite ">
    <div class="container py-5">
          
            <div class="row g-4"style="display:flex;">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-lg-3">
                                <div class="col-lg-12">
                                    <div class="mb-3 fruite-name-bg ">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie ">
                                            @foreach($sections as $section)
                                        <ul class="list-unstyled fruite-categorie">
                                            <li style="padding-top: 10px">
                                                <div class="d-flex justify-content-between section-text">
                                                    <a>{{$section['name']}}</a>
                                                </div>
                                                    @if(count($section['categories']) > 0)
                                                    @foreach($section['categories'] as $category)
                                                    <div class="flex justify-content-between "  >
                                                    <a href="{{url('/'.$category['category_name'])}}">{{$category['category_name']}}</a>
                                                   
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </li>
                                            @endforeach
                                        
                                           
                                        </ul>
                                    </div>
                                </div>
                                
                               <!-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="mb-2">Price</h4>
                                        <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                        <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                    </div>
                                </div>-->
                              @if(!isset($_REQUEST['search']))

                                <div class="col-lg-12">
                                    @foreach ($productFilters as $filter)
                                        <?php
                                        // Pass both filter ID and category ID to the filterAvailable method
                                        $filterAvailable = ProductsFilter::filterAvailable($filter['id'], $categoryDetails['categoryDetails']['id']);
                                        ?>
                                        @if($filterAvailable=="Yes")
                                        <div class="mb-3">
                                            <h4>{{ $filter['filter_name'] }}</h4>
                                                @foreach ($filter['filter_values'] as $value)
                                                    <div class="mb-2">
                                                        <input type="checkbox" class="{{ $filter['filter_column'] }}" id="{{ $value['filter_value'] }}" name="{{ $filter['filter_column'] }}[]" value="{{ $value['filter_value'] }}">
                                                        <label for="{{ $value['filter_value'] }}">{{ ucwords($value['filter_value']) }}</label>
                                                    </div>
                                                    
                                                @endforeach
                                        </div>
                                        @endif
                                    @endforeach
                                </div>

                               <?php 
                      $getSizes = ProductsFilter::getSizes($url); 
                     $allowedSizes = ['Free Size', 'M size','S size','XL size','XXL size','M','S','XL','XXL']; // Define the sizes you want to display
                     $filteredSizes = array_filter($getSizes, function($size) use ($allowedSizes) {
                      return in_array($size, $allowedSizes);
                      });
                      ?>

                  @if (!empty($filteredSizes))
                  <div class="col-lg-12">
                  <h4 class="mb-3">Size</h4>
                 <form action="#" method="post">
                  @foreach ($filteredSizes as $key => $size)
                   <div class="mb-2">
                    <input type="checkbox" class="checkbox size" name="size[]" id="size{{$key}}" value="{{$size}}">
                    <label for="size{{$key}}">{{$size}}</label>
                   </div>
                     @endforeach
                   </form>
                     </div>
                        @endif
                                <?php $getColors=ProductsFilter::getColors($url);?>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Color</h4>
                                    <form action="#" method="post">
                                            @foreach ($getColors as $key=>$color)
                                            <div class="mb-2">
                                            <input type="checkbox" class="checkbox color" name="color[]" id="color{{$key}}" value="{{$color}}">
                                            <label for="color{{$key}}">{{ ucfirst($color) }}
                                            </label>
                                        </div>
                                            @endforeach
                                      
                                    </form>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Price</h4>
                                    <form action="#" method="post">
                                        <?php $prices = array('0-100','100-200','200-300','300-400','400-500');?>
                                        @foreach ($prices as $key=>$price)
                                            <div class="mb-2">
                                            <input type="checkbox" class="checkbox price" name="price[]" id="price{{$key}}" value="{{$price}}">
                                            <label for="price{{$key}}">RM{{$price}}
                                            </label>
                                        </div>
                                        @endforeach 
                                    </form>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Featured products</h4>
                                    @foreach($featuredProducts as $product)
                                    <div class="d-flex align-items-center justify-content-start" style="margin-bottom:10px">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <?php $product_image_path='front/images/product_images/small/'.$product['product_image'];?>
                                            <a href="{{url('product/'.$product['id'])}}" class="fruite-img">
                                                @if(!empty($product['product_image']) && file_exists($product_image_path))
                                                <img src="{{asset($product_image_path)}}" class="img-fluid w-100 rounded-top" alt="">
                                                @else
                                                <img src="{{asset('front/images/product_images/small/no-image.png')}}" class="img-fluid w-100 rounded-top" alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">{{$product['product_name']}}</h6>
                                            <div class="d-flex mb-2">
                                               
                                               
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
                                    @endforeach
                                </div>
                                @endif
                                <!--if need advertisement-->
                                <div class="col-lg-12">
                                    <div class="position-relative" >
                                        @if(isset($fixBanners[1]['image']))
                                        <div class="container" >
                                            <a href="{{ url($fixBanners[1]['link']) }}">
                                                <img class="img-fluid" style="height:300px"title="{{ $fixBanners[1]['title'] }}" src="{{ asset('front/images/banner_images/'.$fixBanners[1]['image']) }}" alt="{{ $fixBanners[1]['alt'] }}">
                                            </a>
                                        </div>
                                        @endif                                       
                                        
                                    </div>
                                </div>
                               
                           
                        </div>
                     
                    