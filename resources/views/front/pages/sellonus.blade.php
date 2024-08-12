<?php use App\Models\Product; ?>

@extends('front.layout.layout')
@section('content')



     <!-- Banner Section Start-->
     <div class="container py-5 h-100">
        <div class="container-fluid py-5 mt-5">
        <div  class="sellonArtNestbanner1"  style="background-image: url('{{ asset('front/img/sellonArtNest_banner.png') }}') ;padding:50px;border-radius:20px">
        <div class="centered text-overlay">
            <div class="row">
                <h1 class="sellonArtNesttitle1" style="text-align: center; align-items: center; color: black; font-weight: 700; font-family: Open Sans; margin-bottom: 40px; margin-top: 16px;">Join ArtNest as a Seller</h1>
            </div>
            <div class="row mt-3 mb-4">
                <div class="col-3 d-flex" style="align-items: center; justify-content: center;">
                    <i class="material-symbols-outlined gradient-icon " > paid </i>     
                     </div>
                <div class="col-9">
                    <h2 class="sellonArtNesttitle2" style="color: black; font-weight: 700; font-family: Open Sans;">Costless</h2>    
                    <p class="sellonArtNestdes" style="color: black; font-size: 18px; font-weight: 400;">ArtNest is accessible to all designers, especially students and emerging designers, by eliminating financial barriers. New sellers also receive one free advertisement to quickly gain initial exposure and reach potential customers.</p> 
                </div>
            </div>   
            <div class="row mb-4">
                <div class="col-3 d-flex" style="align-items: center; justify-content: center;">
                    <i class="material-symbols-outlined gradient-icon" > build</i>
                          </div>
                <div class="col-9">
                    <h2 class="sellonArtNesttitle2" style="color: black; font-weight: 700; font-family: Open Sans;">Powerful tools</h2>    
                    <p class="sellonArtNestdes" style="color: black; font-size: 18px; font-weight: 400;">Our tools and services make it easy to use, manage, promote and grow your business.</p> 
                </div>
            </div> 
            <div class="row">
                <div class="col-3 d-flex" style="align-items: center; justify-content: center;">
                    <i class="material-symbols-outlined gradient-icon" >lock </i>                  
                  </div>
                <div class="col-9">
                    <h2 class="sellonArtNesttitle2" style="color: black; font-weight: 700; font-family: Open Sans;">Secure transactions</h2>    
                    <p class="sellonArtNestdes" style="color: black; font-size: 18px; font-weight: 400;">ArtNest integrates with secure and trusted payment gateways (e.g., PayPal, Stripe) to ensure safe and reliable transactions.</p> 
                </div>
            </div> 
        </div> 
        </div>
    </div>
</div>
    <!-- Banner Section End -->
     <!-- Category Section Start-->
        <div class="container">
            <h1 class="" style="text-align: center; align-items: center; color: black; font-weight: 700; font-family: Open Sans; margin-bottom: 80px;">What can you sell on ArtNest?</h1>       
            <div class="tab-class text-center">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-6 col-xl-3 product">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset ('front/img/lp_product1.png') }}" class="img-fluid w-100 rounded-top" alt="lp_product1">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h5 style="display: flex; align-items: center; justify-content: center; font-family: Open Sans; font-weight: 600; color: black;">Art</h5>
                                            </div>
                                        </div>       
                                        </div>    
                                  
                                    <div class="col-md-6 col-lg-6 col-xl-3 product">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset ('front/img/lp_product2.png') }}" class="img-fluid w-100 rounded-top" alt="lp_product2">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h5 style="display: flex; align-items: center; justify-content: center; font-family: Open Sans; font-weight: 600; color: black;">Clothing</h5>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6 col-lg-6 col-xl-3 product">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset ('front/img/lp_product3.png') }}" class="img-fluid w-100 rounded-top" alt="lp_product3">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h5 style="display: flex; align-items: center; justify-content: center; font-family: Open Sans; font-weight: 600; color: black;">Bag</h5>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-3 product">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ asset ('front/img/lp_product4.png') }}" class="img-fluid w-100 rounded-top" alt="lp_product4">
                                            </div>    
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h5 style="display: flex; align-items: center; justify-content: center; font-family: Open Sans; font-weight: 600; color: black;">Jewelry</h5>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>     
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
    
      <!-- Category Section End-->

        <!-- Seller Stories Section Start-->
            <div class="container" style="padding-top: 100px ;padding-bottom:100px;">
                <h1 class="" style="text-align: center; align-items: center; color: black; font-weight: 700; font-family: Open Sans; margin-bottom: 80px;">Seller's Stories</h1>       
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{asset('front/img/sellerstory1.png')}}" class="" style="width: 100%; align-items: center; justify-content: center;" alt="">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('front/img/sellerstory2.png')}}" class="d-block" style="width: 100%;" alt="">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="material-symbols-outlined" style="color: black; transform: rotate(180deg); font-size: 28px; font-weight: 600;">chevron_right</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="material-symbols-outlined" style="color: black; font-size: 28px; font-weight: 600;">chevron_right</span>
                </button>
              </div>
            </div> 
           
            <!-- Seller Stories Section End-->
             <!-- Banner2 Section Start-->
             <div class="container-fluid col-lg-12 pad " 
             style="background-image: url('{{ asset('front/img/sellonArtNest_banner2.png') }}');  background-size: cover;  background-position: center; background-repeat: no-repeat; padding: 20px 0;">
            <div class="centered text-overlay">
                <div class="row mb-4 mt-3 text-center">
                    <h1 class="mb-4 sellonArtNesttitle3" >
                        Open your ArtNest store for <span style="color: #f26b4e;">Free</span>
                    </h1>
                    <p class="mb-4 sellonArtNestdes" >
                        Build, promote and start selling from ArtNest.
                    </p>
                    <a href="{{url('vendor/register')}}" 
                       class=" text-white ml-2" 
                       style="background-image: linear-gradient(to right, #f8a239, #f26b4e); box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.1); 
                              width: 198px; 
                               height: 47px; 
                              border-radius: 10px; 
                              font-size: 20px; 
                              font-weight: 600; 
                              text-align: center; 
                              display: inline-flex; 
                              align-items: center; 
                              justify-content: center; 
                              margin: auto;">
                        Start Selling
                    </a>
                </div>  
            </div> 
        </div>
        <!-- Banner2 Section End-->
@endsection