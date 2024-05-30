<h4 class="deliveryText">Add New Delivery Address</h4>
@if (count($deliveryAddresses)>0)

<p class="newAddress"><input type="checkbox" id="myCheck" class="newAddress" onclick="toggleForm()">Ship to a different Address?</p>
@else
<p class="newAddress"><input type="checkbox" id="myCheck" class="newAddress" onclick="toggleForm()">Check to add Delivery Address</p>

@endif
<form id="addressAddEditForm" action="javascript:;" method="post">@csrf    

<input type="hidden" name="delivery_id"  >

<div id="formContainer" class="form-container" >
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
        <select name="delivery_state" id="delivery_state" class="form-control">
            <option value="">Select State</option>
            <option value="Johor">Johor</option>
            <option value="Kedah">Kedah</option>
            <option value="Kelantan">Kelantan</option>
            <option value="Melaka">Melaka</option>
            <option value="Negeri Sembilan">Negeri Sembilan</option>
            <option value="Pahang">Pahang</option>
            <option value="Perak">Perak</option>
            <option value="Perlis">Perlis</option>
            <option value="Pulau Pinang">Pulau Pinang</option>
            <option value="Sabah">Sabah</option>
            <option value="Sarawak">Sarawak</option>
            <option value="Selangor">Selangor</option>
            <option value="Terengganu">Terengganu</option>
            <option value="Kuala Lumpur">Kuala Lumpur</option>
            <option value="Labuan">Labuan</option>
            <option value="Putrajaya">Putrajaya</option>
        </select>
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

