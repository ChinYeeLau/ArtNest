<?php use App\Models\Product; ?>
@extends('front.layout.layout')
@section('content')
   <!-- Wishlist Page Start -->
  
   <div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
      <h2 style="text-align:center">My Wishlist</h2>

    <div class="container py-5">
        @if(Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error</strong> {{Session::get('error_message')}}
          <button type="button" class="close close-button"style="float:right;" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success</strong> {{Session::get('success_message')}}
          <button type="button" class="close close-button"style="float:right;"  data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div id="appendWishlistItems">
            @include('front.products.wishlist_items')
        </div>
  
   
    </div>
   
 
    </div>
</div>
</div>
<!-- Wishlist Page End -->
@endsection
