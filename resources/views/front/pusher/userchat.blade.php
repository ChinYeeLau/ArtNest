@extends('front.layout.layout')
@section('content')
<div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
    <div class="container py-5">
<div class="chat">
    <p>Test</p>
 <div class="top">
    <div>
    <p>Test</p>
    <small>Online</small>
</div>
 </div>
 <div class="messages">
     @include('front.pusher.userreceive',['message'=>"hey"])
 </div>
 <div class="bottom">
    <form id="chatForm">
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
        $.post("/user/receive", {
            _token: '{{ csrf_token() }}',
            message: data.message,
        }).done(function(res) {
            $(".messages").append(res);
            $(document).scrollTop($(document).height());
        });
    });

    // Broadcast message
    $("#chatForm").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "/user/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("#message").val(),
            }
        }).done(function(res) {
            $("#message").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>

 @endsection