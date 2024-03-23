<?php use App\Models\Product; ?>
@extends('front.layout.layout')
@section('content')
   <!-- Cart Page Start -->
  
   <div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div id="appendCartItems">
       @include ('front.products.cart_items')
    </div>
    </div>
</div>
</div>
<!-- Cart Page End -->
@endsection