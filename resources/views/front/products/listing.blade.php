<?php 
use App\Models\Section;
use App\Models\Category;
$sections=Section::sections();
?>
@extends('front.layout.layout')
@section('content')
@include('front.products.filters')

    <div class="col-lg-9">
        <div class="row g-4 justify-content-center">
            <div class="row g-4">
            <div class="col-xl-3">
              <!--<div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        @if(isset($categoryDetails['categoryDetails']['section']['name']))
                        <li class="breadcrumb-item"><a href="#">{{$categoryDetails['categoryDetails']['section']['name']}}</a></li>
                    @endif
                      <?php echo $categoryDetails['breadcrumbs']; ?>
                    </ol>
                  </div>-->
                
            </div>
            @if(!isset($_REQUEST['search']))

            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-3">       
            <label for="sort" >Default By:</label>
            <form name="sortProducts" id="sortProducts">
                <input type="hidden" name="url" id="url" value="{{$url}}">
            <div class="toolbar-sorter">
                                               <select id="sort" name="sort" class="border-0 form-select-sm bg-light me-3" >
                                                    <option selected="" value="">Select</option>
                                                    <option value="product_latest" @if (isset($_GET['sort'])&& $_GET['sort']=="product_latest" )selected="" @endif>Latest Product</option>
                                                    <option value="name_a_z" @if (isset($_GET['sort'])&& $_GET['sort']=="name_a_z" )selected="" @endif>Name A-Z</option>
                                                    <option value="name_z_a"@if (isset($_GET['sort'])&& $_GET['sort']=="name_z_a" )selected="" @endif>Name Z-A</option>
                                                    <option value="price_lowest"@if (isset($_GET['sort'])&& $_GET['sort']=="price_lowest" )selected="" @endif>Lowest Price</option>
                                                    <option value="price_highest"@if (isset($_GET['sort'])&& $_GET['sort']=="price_highest" )selected="" @endif>Highest Price</option>
                                                </select>
                                            </div>
                                            
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
    
        <div class="filter_products">
            @include('front.products.ajax_products_listing')
      
           
        </div>
        <div>{{$categoryDetails['categoryDetails']['description']}}</div>

       
       
    
       
        
   
        <?php /* <div class="col-12">
           <div class="pagination d-flex justify-content-center mt-5">
                <a href="#" class="rounded">&laquo;</a>
                <a href="#" class="active rounded">1</a>
                <a href="#" class="rounded">2</a>
                <a href="#" class="rounded">3</a>
                <a href="#" class="rounded">4</a>
                <a href="#" class="rounded">5</a>
                <a href="#" class="rounded">6</a>
                <a href="#" class="rounded">&raquo;</a>
            </div>*/?>
        
        
    </div>
    
</div>
</div>
</div>
</div>
</div>
</div>

            
                       
                             
                              
    <!-- Fruits Shop End-->
    @endsection