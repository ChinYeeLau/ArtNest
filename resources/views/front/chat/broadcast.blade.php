<div class="message right">
   
    @if(!empty(Auth::user()->image))
        <img src="{{ url('front/images/photos/' . Auth::user()->image) }}" alt="User Photo" class="user-photo" style="margin-top:5px;">
    @else
        <span class="material-symbols-outlined icon">person</span>
    @endif
    <p>{{ $message }}</p>
</div>