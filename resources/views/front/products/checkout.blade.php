<?php use App\Models\Product; ?>
@extends('front.layout.layout')
@section('content')

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
       
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-6" style="padding-top:50px;">
                    <!-- Error and Success Messages -->
                    @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> {{ Session::get('error_message') }}
                            <button type="button" class="close close-button" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close close-button" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <!-- Delivery Addresses -->
                    <div id="deliveryAddresses">
                        @include('front.products.delivery_addresses')
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-6" style="padding-top:50px;">
                    <form name="checkoutForm" id="checkoutForm" action="{{ url('/checkout') }}" method="post">
                        @csrf
                    @if (count($deliveryAddresses)>0)
                    <h4 class="mb-4"> Delivery Addresses</h4>
                    <div id="deliveryAddresses">
                  @foreach($deliveryAddresses as $address)
                <div style="float:left;margin-right:8px;" class="control-group">
                <input type="radio"  id="address{{$address['id']}}" name="address_id" value="{{$address['id']}}" ></div>
                <div>
                 <label class="control-label">{{$address['name']}}, {{$address['address']}}, {{$address['state']}}, {{$address['postcode']}} ({{$address['mobile']}})</label>
                 <a style="float:right;" href="javascript:;" data-addressid="{{$address['id']}}" class="removeAddress">Remove</a>
                 <a style="float:right;margin-right:10px;" href="javascript:;" data-addressid="{{$address['id']}}" class="editAddress">Edit</a>
 
                </div>
                <br>
                <br>
                @endforeach
               </div>
                   @endif
                    <h4>Your Order</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col"></th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col"></th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_price = 0 @endphp
                                @foreach($getCartItems as $item)
                                    @php
                                    $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                                    @endphp
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ url('product/' . $item['product_id']) }}">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{ asset('front/images/product_images/small/' . $item['product']['product_image']) }}" class="img-fluid me-5" style="width: 80px; height: 80px;" alt="Product">
                                                    <p>{{ $item['product']['product_name'] }}<br>Size: {{ $item['size'] }}</p>
                                                </div>
                                            </a>
                                        </th>
                                        <td class="py-5"></td>
                                        <td class="py-5" style="text-align:center;">{{ $item['quantity'] }}</td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <p class="text-dark product-price">RM {{ $getDiscountAttributePrice['final_price'] * $item['quantity'] }}</p>
                                        </td>
                                    </tr>
                                    @php $total_price += $getDiscountAttributePrice['final_price'] * $item['quantity'] @endphp
                                @endforeach
                                <tr>
                                    <th scope="row"></th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark fw-bold py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">RM {{ $total_price }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-4">Shipping Charges</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">RM 0</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-4">Coupon Discount</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">
                                                @if(Session::has('couponAmount'))
                                                    RM {{ Session::get('couponAmount') }}
                                                @else
                                                    RM 0
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark fw-bold py-3">GRAND TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">RM {{ $total_price - Session::get('couponAmount', 0) }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="cash-on-delivery" name="payment_gateway" value="COD">
                                <label class="form-check-label" for="cash-on-delivery">Cash On Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="paypal" name="payment_gateway" value="Paypal">
                                <label class="form-check-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button id= "placeOrder" type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                </form>
                </div>
            </div>
       
    </div>
</div>
<!-- Checkout Page End -->
@endsection