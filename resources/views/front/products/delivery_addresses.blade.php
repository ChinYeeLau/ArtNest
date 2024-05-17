@if (count($deliveryAddresses)>0)
<h4 class="mb-4"> Delivery Addresses</h4>
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
<h4 class="deliveryText">Add New Delivery Address</h4>
<p class="newAddress"><input type="checkbox" id="myCheck" class="newAddress" onclick="toggleForm()">Ship to a different Address?</p>
<form id="addressAddEditForm" action="javascript:;" method="post">@csrf    

<input type="hidden" name="delivery_id"  >

<div id="formContainer" class="form-container">
    <div class="form-item">
        <label class="form-label my-3">Name<sup>*</sup></label>
        <input type="text" class="form-control" name="delivery_name" id="delivery_name">
        <p id="delivery-delivery_name"></p>
    </div>
    <div class="form-item">
        <label class="form-label my-3">Address <sup>*</sup></label>
        <input type="text" class="form-control"  name="delivery_address" id="delivery_address">
        <p id="delivery-delivery_address"></p>
    </div>
    <div class="form-item">
        <label class="form-label my-3">State<sup>*</sup></label>
        <input type="text" name="delivery_state" id="delivery_state" class="form-control">
        <p id="delivery-delivery_state"></p>
    </div>
    <div class="form-item">
        <label class="form-label my-3">Postcode<sup>*</sup></label>
        <input type="text"  name="delivery_postcode" id="delivery_postcode" class="form-control">
        <p id="delivery-delivery_postcode"></p>
    </div>
    <div class="form-item">
        <label class="form-label my-3">Mobile<sup>*</sup></label>
        <input type="tel"  name="delivery_mobile" id="delivery_mobile" class="form-control">
        <p id="delivery-delivery_mobile"></p>
    </div>
    <div class="form-item btn " style="padding-top:20px;">
        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Save</button>
    </div>
</div>
</form>
@else
<h4 class="deliveryText">Add New Delivery Address</h4>
<form id="addressAddEditForm" action="javascript:;" method="post">@csrf
    
<input type="hidden" name="delivery_id"  >

<div id="formContainer" class="form-container">
    <div class="form-item">
        <label class="form-label my-3">Name<sup>*</sup></label>
        <input type="text" class="form-control" name="delivery_name" id="delivery_name">
    </div>
    <div class="form-item">
        <label class="form-label my-3">Address <sup>*</sup></label>
        <input type="text" class="form-control"  name="delivery_address" id="delivery_address" placeholder="House Number Street Name">
    </div>
    <div class="form-item">
        <label class="form-label my-3">State<sup>*</sup></label>
        <input type="text" name="delivery_state" id="delivery_state" class="form-control">
    </div>
    <div class="form-item">
        <label class="form-label my-3">Postcode<sup>*</sup></label>
        <input type="text"  name="delivery_postcode" id="delivery_postcode" class="form-control">
    </div>
    <div class="form-item">
        <label class="form-label my-3">Mobile<sup>*</sup></label>
        <input type="tel"  name="delivery_mobile" id="delivery_mobile" class="form-control">
    </div>
    <div class="form-item btn " style="padding-top:20px;">
        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Save</button>
    </div>
</div>
</form>
@endif
