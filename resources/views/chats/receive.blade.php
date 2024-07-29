<div class="message left">
    @if(!empty($senderImage))
        <img src="{{ url('front/images/photos/' . $senderImage) }}" alt="Sender Photo" class="user-photo" style="margin-top:5px;">
    @else
        <span class="material-symbols-outlined icon">person</span>
    @endif
    <p>{{$message}}</p>
</div>