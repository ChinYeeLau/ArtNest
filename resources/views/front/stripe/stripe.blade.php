@extends('front.layout.layout')
@section('content')
<div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5 ">
        <div class="container py-5" style="text-align: center;">
            <div class="card">
                <div class="card-header text-center">
                    @php
                        $fee = Session::get('grand_total') * 0.03 + 1; 
                        $tax = round($fee * 0.06 + $fee, 2);
                    @endphp
                    <h3>PLEASE MAKE <span style="color:#f26b4e"> RM {{ round(Session::get('grand_total'), 2) }} + Transaction fees with tax RM {{$tax}}</span> PAYMENT FOR YOUR ORDER </h3>
                </div>

                <div class="card-body">
                    <form class="require-validation" method="POST" action="{{ route('stripe.pay') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="card-name" class="col-md-4 col-form-label text-md-right">Name on Card</label>
                            <div class="col-md-6">
                                <input id="card-name" type="text" class="form-control" name="card-name" required autofocus>
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label for="card-element" class="col-md-4 col-form-label text-md-right">Credit or Debit Card</label>
                            <div class="col-md-6">
                                <div id="card-element" class="form-control">
                                    <!-- Stripe Element will be inserted here -->
                                </div>
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>
                       <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="stripe-paynow rounded-pill active tab-link" id="stripePayNow" type="submit">Pay Now</button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   <script src="https://js.stripe.com/v3/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
            // Set your publishable key
            var stripe = Stripe('pk_test_51POh0o2MIDC0YYntaJP1jPNyMBVlnb5u8xXo8MmduhY0D4a4NHMfNHJLAL54jXY7yqOHriQveollWGaA6aOlG05D00l6WthCIz');
            var elements = stripe.elements();

            // Create an instance of the card Element
            var card = elements.create('card');

            // Add an instance of the card Element into the `card-element` div
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
  // Handle form submission
  var form = document.querySelector('.require-validation');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID
            function stripeTokenHandler(token) {
                var form = document.querySelector('.require-validation');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
      
    </script>
@endsection
