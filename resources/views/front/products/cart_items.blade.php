<?php use App\Models\Product; ?>
<div class="table-responsive">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Products</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @php $total_price=0 @endphp
            @foreach($getCartItems as $item)
            <?php $getDiscountAttributePrice=Product::getDiscountAttributePrice($item['product_id'],$item['size']);
            ?>
            <tr>
                <th scope="row">
                    <a href="{{url('product/'.$item['product_id'])}}">
                    <div class="d-flex align-items-center">
                        <img src="{{asset('front/images/product_images/small/'.$item['product']['product_image'])}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="Product">
                    <h6>{{$item['product']['product_name']}}({{$item['product']['product_code']}})-{{$item['size']}}      
                    </h6>
                
                    </div>
                </a>
                </th>
              
               
                <td>
                    <p class="mb-0 mt-4 ">@if( $getDiscountAttributePrice['discount'] > 0)
                        <p class="red-text fs-5 fw-bold mb-0 product-price" >RM{{ $getDiscountAttributePrice['final_price'] }}</p>
                        <p class="text-dark fs-5 fw-bold mb-0 product-discount-price" style=" text-decoration: line-through;">RM{{ $getDiscountAttributePrice['product_price'] }}</p>
                    @else 
                        <p class="text-dark fs-5 fw-bold mb-0 product-price">RM{{ $getDiscountAttributePrice['final_price'] }}</p>
                    @endif</p>
                </td>
                <td>
                    <div class="input-group quantity mt-4" style="width: 100px;">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-minus rounded-circle bg-light border updateCartItem"data-cartid="{{$item['id']}}" data-qty="{{$item['quantity']}}" >
                            <i class="fa fa-minus "></i>
                            </button>
                        </div>
                        <input type="text" class="form-control form-control-sm text-center border-0" value="{{$item['quantity']}}">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-plus rounded-circle bg-light border updateCartItem" data-cartid="{{$item['id']}}" data-qty="{{$item['quantity']}}">
                                <i class="fa fa-plus " ></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="mb-0 mt-4 text-dark fs-5 fw-bold mb-0 product-price"> RM{{ $getDiscountAttributePrice['final_price']*$item['quantity'] }}</p>
                </td>
                <td>
                    <button class="btn btn-md rounded-circle bg-light border mt-4  deleteCartItem" data-cartid="{{$item['id']}}">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                </td>
                
            </tr>
           
            @php $total_price=$total_price + ($getDiscountAttributePrice['final_price']*$item['quantity']) @endphp
            @endforeach
               
        </tbody>
    </table>

</div>



<div class="mt-5">
    <form id="ApplyCoupon" method="post" action="javascript:void(0);" @if(Auth::check()) user="1" @endif >@csrf
        <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4 text-field" id="code" name="code" placeholder="Enter Coupon Code">
        <button class="btn border-secondary rounded-pill align-items-center justify-content-center" type="submit">Apply Coupon</button>
    </form>
</div>


<div class="row g-4 justify-content-end">
    <div class="col-8"></div>
    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
        <div class="bg-light rounded">
            <div class="p-4">
                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="mb-0 me-4">Subtotal:</h5>
                    <p class="mb-0">RM {{$total_price}}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="mb-0 me-4">Coupon Discount:</h5>
                    <div class="">
                        <p class="mb-0 couponAmount">
                            @if(Session::has('couponAmount'))
                            RM {{Session::get('couponAmount')}}
                        @else
                        RM 0
                    @endif</p>
                    </div>
                </div>
               
            </div>
            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                <h5 class="mb-0 ps-4 me-4">Total</h5>
                <p class="mb-0 pe-4 grand_total">RM {{$total_price-Session::get('CouponAmount')}}</p>
            </div>
            <button class="btn border-secondary rounded-pill  align-items: center; justify-content: center; mb-4 ms-4" type="button">Proceed Checkout</button>
        </div>
    </div>
</div>