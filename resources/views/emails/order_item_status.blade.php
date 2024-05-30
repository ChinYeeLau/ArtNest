<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Item Status Update</title>
</head>
<body>
    <table style="width:700px;">
        <tr>
            <td><img src="{{ asset('front/img/ART.NEST.png') }}" alt="ArtNest Logo"></td>
        </tr>
        <tr>
            <td>Hello {{ $name }},</td>
        </tr>
        <tr>
            <td>Thank you for shopping with us. Your order details with updated order #{{$order_id}} item status to {{$order_status}}.</td>
        </tr>
        
        @if(!empty($courier_name)&&!empty($tracking_number))
        <tr><td>Courier Name is {{$courier_name}} and Tracking Number is {{$tracking_number}}</td></tr>
        <tr>@endif
        <tr>
            <td>
                <table style="width:95%;" cellpadding="5" cellspacing="0" border="1">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Quantity</th>
                            <th>Product Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderDetails['orders_products'] as $order)
                        <tr>
                            <td>{{ $order['product_name'] }}</td>
                            <td>{{ $order['product_code'] }}</td>
                            <td>{{ $order['product_size'] }}</td>
                            <td>{{ $order['product_color'] }}</td>
                            <td>{{ $order['product_qty'] }}</td>
                            <td>RM {{ $order['product_price'] }}</td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td><strong>Delivery Address:</strong></td>
        </tr>
        <tr>
            <td>{{ $orderDetails['name'] }}</td>
        </tr>
        <tr>
            <td>{{ $orderDetails['address'] }}</td>
        </tr>
        <tr>
            <td>{{ $orderDetails['state'] }}</td>
        </tr>
        <tr>
            <td>{{ $orderDetails['postcode'] }}</td>
        </tr>
        <tr>
            <td>({{ $orderDetails['mobile'] }})</td>
        </tr>
        <tr>
        <tr>
            <td>For any queries, you can contact us at <a href="mailto:info@artnest.online">info@artnest.online</a></td>
        </tr>
        <tr>
            <td>Regards,<br>Team ArtNest</td>
        </tr>
    </table>
</body>
</html>