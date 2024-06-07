@extends('front.layout.layout')
@section('content')
   <div class="container h-100">
      <div class="container-fluid py-5 mt-5">
         <div class="container py-5 text-center">
            <h3>PLEASE MAKE <span style="color:#f26b4e"> RM {{ round(Session::get('grand_total'), 2) }}</span> PAYMENT FOR YOUR ORDER </h3>
         </div>
         <div class="text-center">
            <a href="{{ url('stripe/pay') }}">
               <button class="stripe-paynow">Pay Now</button>
            </a>
         </div>
       
      </div>
   </div>
@endsection
