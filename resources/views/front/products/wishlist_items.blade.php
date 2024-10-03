<div class="table-responsive">
    @if(count($getWishlistItems) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($getWishlistItems as $item)
                <tr>
                    <th scope="row">
                        <a href="{{ url('product/'.$item['product_id']) }}">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('front/images/product_images/small/'.$item['product']['product_image']) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="Product">
                                <h6>({{ $item['product']['product_code'] }}) - {{ $item['product']['product_name'] }}</h6>
                            </div>
                        </a>
                    </th>
                    <td>
                        <button class="btn btn-md rounded-circle bg-light border mt-4 deleteWishlistItem" data-wishlistid="{{ $item['id'] }}">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h5 style="text-align: center; color:#d9d9d9">Your Wishlist is Empty.</h5>
    @endif
</div>
