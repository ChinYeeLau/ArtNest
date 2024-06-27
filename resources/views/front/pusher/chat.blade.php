@extends('front.layout.layout')
@section('content')
<div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5">
<div class="chat">
    <p>Test</p>
 <div class="top">
    @if(!empty(Auth::user()->image))
    <img src=" {{ url('front/images/photos/' . Auth::user()->image) }}"  alt="User Photo" class="user-photo">
    @else
<i class="fa-solid fa-user fa-2x" style="color: #f26b4e; "></i>
  @endif
   
    <p>Test</p>
    <small>Online</small>

 </div>
 <div class="messages">
     @include('front.pusher.receive',['message'=>"hey"])
 </div>
 <div class="bottom">
    <form>
        <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
        <button type="submit"></button>
    </form>
</div>
</div>
</div>
</div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
 <script>
    // Initialize Pusher
    const pusher = new Pusher('{{env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1'
    });

    const channel = pusher.subscribe('public');

    // Receive messages
    channel.bind('chat', function(data) {
        $.post("/receive", {
            _token: '{{ csrf_token() }}',
            message: data.message,
        }).done(function(res) {
            $(".messages >.message").last().after(res);
            $(document).scrollTop($(document).height());
        });
    });

    // Broadcast message
    $("form").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("form #message").val(),
            }
        }).done(function(res) {
            $(".messages >.message").last().after(res);
            $("form #message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>

 @endsection