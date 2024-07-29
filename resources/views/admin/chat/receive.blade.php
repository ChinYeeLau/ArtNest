<div class="message left">
    @if(!empty($senderImage))
        <img src="{{ url('admin/images/photos/'  . $senderImage) }}" alt="User Photo" class="user-photo" style="margin-top:5px;">
    @else
    <img src="{{ url('admin/images/photos/no-image.png') }}" >
    @endif
    <p>{{ $message }}</p>
</div>