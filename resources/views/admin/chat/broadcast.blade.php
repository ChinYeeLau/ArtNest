<div class="message right">
    
    @php
        $userImage = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->image : null;
    @endphp
    @if($userImage)
        <img src="{{ url('admin/images/photos/' . $userImage) }}" alt="User Image" class="user-photo">
        <input type="hidden" name="current_vendor_image" value="{{ $userImage }}">
    @else
        <img src="{{ url('admin/images/photos/no-image.png') }}" alt="No Image Available" class="user-photo">
    @endif
    <p>{{ $message }}</p>
</div>