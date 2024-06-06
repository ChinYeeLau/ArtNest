@extends('front.layout.layout')
@section('content')
   <div class="container h-100">
      <div class="container-fluid py-5 mt-5">
         <div class="container py-5 text-center">
            <h3>PLEASE MAKE <span style="color:#f26b4e"> RM {{ round(Session::get('grand_total'), 2) }}</span> PAYMENT FOR YOUR ORDER </h3>
         </div>
         <div class="row justify-content-center">
            <div class="col-md-6">
               <h2 class="mb-4 text-center">Stripe Payment Page</h2>
               <form id="payment-form">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" id="name" name="name" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" id="email" name="email" class="form-control" required>
                  </div>
                  <div id="card-element" class="form-group">
                     <!-- Stripe Card Element will be inserted here -->
                  </div>
                  <div class="form-group">
                     <label for="address">Address</label>
                     <textarea id="address" name="address" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                     <label for="city">City</label>
                     <input type="text" id="city" name="city" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label for="zip">ZIP Code</label>
                     <input type="text" id="zip" name="zip" class="form-control" required>
                  </div>
                  <br>
                  <div class="text-center">
                     <a href="{{ url('stripe/pay') }}">
                        <button class="stripe-paynow">Pay Now</button>
                     </a>
                  </div>
                  <div id="card-error" role="alert" class="mt-2" style="color: red;"></div>
                  <div id="card-success" role="alert" class="mt-2" style="color: green;"></div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection
