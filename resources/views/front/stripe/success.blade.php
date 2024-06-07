<?php use App\Models\Product; ?>
@extends('front.layout.layout')
@section('content')
   <!-- Cart Page Start -->
  
   <div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5" style="text-align: center;">
       <h3>YOUR PAYMENT HAS BEEN CONFIRMED</h3>
       <P>Thanks for the Payment.We will process your order very soon.</P>
       @php  $fee = Session::get('grand_total') * 0.03+1; 
            $tax=round($fee * 0.06 + $fee, 2); @endphp
       <p>Your order number is {{Session::get('order_id')}} and total amount paid is RM {{Session::get('grand_total')}}+Transaction fees with tax RM {{$tax}}</p>
       
    </div>
</div>
</div>
<!-- Cart Page End -->
@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');
Session::forget('couponCode');
Session::forget('couponAmount');
?>