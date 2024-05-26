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
            <td>Thank you for shopping with us. Your order details with updated item status are as below:</td>
        </tr>
        <tr>
            <td>Order No. {{ $order_id }}</td>
        </tr>
        @if(!empty($courier_name)&&!empty($tracking_number))
        <tr><td>Courier Name is {{$courier_name}} and Tracking Number is {{$tracking_number}}</td></tr>
        <tr>@endif
        <tr>
            <td>
                <table style="width:95%" cellpadding="5" cellspacing="0" border="1">
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
                    @foreach($orderDetails['orders_products'] as $orderProduct)
                    @if($orderProduct['id'] == $order_item_id) <!-- Check if the current product matches the updated item -->
                    <tr>
                        <td>{{ $orderProduct['product_name'] }}</td>
                        <td>{{ $orderProduct['product_code'] }}</td>
                        <td>{{ $orderProduct['product_size'] }}</td>
                        <td>{{ $orderProduct['product_color'] }}</td>
                        <td>{{ $orderProduct['product_qty'] }}</td>
                        <td>{{ $orderProduct['product_price'] }}</td>
                    </tr>
                    
                    @endif
                    @endforeach
                </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>For any queries, you can contact us at <a href="mailto:info@artnest.online">info@artnest.online</a></td>
        </tr>
        <tr>
            <td>Regards,<br>Team ArtNest</td>
        </tr>
    </table>
</body>
</html>