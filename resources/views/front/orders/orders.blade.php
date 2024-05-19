@extends('front.layout.layout')
@section('content')
   <!-- Cart Page Start -->
  
   <div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5" style="text-align: center;">
       <h3>My Orders</h3>   
    </div>
<table class="table table-striped table-borderless">
<tr class="table-info">
    <th>Order ID</th>
    <th>Order Products</th>
    <th>Payment Method</th>
    <th>Grand Total</th>
    <th>Created on</th>

</tr>
@foreach($orders as $order)
<tr>
    <td><a href="{{url('user/orders/'.$order['id'])}}">{{$order['id']}}</a></td>
    <td>
         @foreach($order['orders_products'] as $product)
        {{ $product['product_code'] }}<br>
    @endforeach
    </td>
    <td>{{$order['payment_method']}}</td>
    <td>{{$order['grand_total']}}</td>
    <td>{{date('Y-m-d h:i:s',strtotime($order['created_at']));}}</td>

</tr>
@endforeach
</table>
</div>
</div>
<!-- Cart Page End -->
@endsection