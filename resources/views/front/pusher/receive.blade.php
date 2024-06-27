
<div class="left message">
    @if(!empty(Auth::user()->image))
    <img src=" {{ url('front/images/photos/' . Auth::user()->image) }}"  alt="User Photo" class="user-photo">
    @else
<i class="fa-solid fa-user fa-2x" style="color: #f26b4e; "></i>
  @endif
     <p>{{$message}}</p>
</div>

