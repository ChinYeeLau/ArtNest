<?php use App\Models\Product; ?>
@extends('front.layout.layout')
@section('content')
   <!-- Cart Page Start -->
  
   <div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5" style="text-align: center;">
       <h3>PLEASE MAKE PAYMENT FOR YOUR ORDER </h3>
       <form action="{{ route('paypal.pay') }}" method="POST" >@csrf
        <input type="hidden"  name="amount" value="{{(Session::get('grand_total'))}}"><br>
        <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png">
    </form>       
    </div>
</div>
</div>
<!-- Cart Page End -->
@endsection