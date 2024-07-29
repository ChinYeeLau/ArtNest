<div class="message right">
    <p>{{ $message }}</p>
    @if(!empty(Auth::guard('admin')->user()->image))
    <img src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}">
    <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
    @else
    <img src="{{ url('admin/images/photos/no-image.png') }}" >
    @endif
</div>