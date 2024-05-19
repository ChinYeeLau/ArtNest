<?php use App\Models\Product; ?>
@extends('front.layout.layout')
@section('content')
   <!-- Cart Page Start -->
  
   <div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5" style="text-align: center;">
       <h3>YOUR ORDER HAS BEEN PLACED SUCCESSFULLY</h3>
       <p>Your order number is {{Session::get('order_id')}} and Grand total is RM {{Session::get('grand_total')}}</p>
       
    </div>
</div>
</div>
<!-- Cart Page End -->
@endsection