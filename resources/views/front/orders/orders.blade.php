@extends('front.layout.layout')
@section('content')
   <!-- Cart Page Start -->
  
   <div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5" style="text-align: center;">
       <h3>My Orders</h3>   
    </div>
    <table class="table table-striped table-borderless">
        <thead class="table-orange text-white">
            <tr>
                <th>Order ID</th>
                <th>Order Products</th>
                <th>Payment Method</th>
                <th>Grand Total</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody class="clickable">
            @foreach($orders as $order)
            <tr>
                <td><a href="{{url('user/orders/'.$order['id'])}}" class="table-row-link ">{{$order['id']}}</a></td>
                <td>
                     @foreach($order['orders_products'] as $product)
                     <a href="{{url('user/orders/'.$order['id'])}}" class="table-row-link"> {{ $product['product_code'] }}<br>
                @endforeach
                </td>
                <td><a href="{{url('user/orders/'.$order['id'])}}" class="table-row-link">{{$order['payment_method']}}</td>
                <td><a href="{{url('user/orders/'.$order['id'])}}" class="table-row-link">{{$order['grand_total']}}</td>
                <td><a href="{{url('user/orders/'.$order['id'])}}" class="table-row-link">{{date('Y-m-d h:i:s',strtotime($order['created_at']));}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    <!-- Cart Page End -->
@endsection

@section('styles')

@endsection