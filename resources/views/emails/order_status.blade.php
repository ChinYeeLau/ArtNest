<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>
    <table style="width:700px;">
        <tr>
            <td><img src="{{ asset('front/img/ART.NEST.png') }}" alt="ArtNest Logo"></td>
        </tr>
        <tr>
            <td>Hello {{ $name }}</td>
        </tr>
        <tr>
            <td>Your Order #{{ $order_id }} status has been updated to {{$order_status}} </td>
        </tr>
        <tr>
            <td>Your Order details are as below:</td>
        </tr>
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
                        <tr>
                            <td colspan="5" align="right">Shipping Charges</td>
                            <td>RM {{ $orderDetails['shipping_charges'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right">Coupon Discount</td>
                            <td>RM 
                                @if($orderDetails['coupon_amount']>0)
                                {{ $orderDetails['coupon_amount'] }}
                            @else
                                0
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right"><strong>Grand Total</strong></td>
                            <td><strong>RM {{ $orderDetails['grand_total'] }}</strong></td>
                        </tr>
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
            <td>{{ $orderDetails['mobile'] }}</td>
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