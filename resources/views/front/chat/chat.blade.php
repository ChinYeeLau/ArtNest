@extends('front.layout.layout')
@section('content')
<div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5">
<div class="chat">

    <!-- Header -->
    <div class="top">
        @if(!empty($senderImage))
        <img src="{{ url('front/images/photos/' . $senderImage) }}" alt="Sender Photo" class="user-photo" style="margin-top:5px;">
        @else
        <span class="material-symbols-outlined icon"> person </span>   
     @endif
      <div>
        <p>test</p>
        <small>Online</small>
      </div>
    </div>
    <!-- End Header -->
  
    <!-- Chat -->
    <div class="messages">
      @include('front.chat.receive', ['message' => "Hey! What's up! "])
      
    </div>
    <!-- End Chat -->
  
    <!-- Footer -->
    <div class="bottom">
      <form>
        <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
        <button type="submit" class="send-button">Send</button>
    </form>
    </div>
    <!-- End Footer -->

</div>
</div>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', { cluster: 'ap1' });
    const channel = pusher.subscribe('public');

    //Receive messages
    channel.bind('chat', function (data) {
        $.post("/user/receive", {
            _token: '{{csrf_token()}}',
            message: data.message,
            senderImage: data.senderImage // Include sender's image URL
        })
        .done(function (res) {
            $(".messages > .message").last().after(res);

            // Check if user is at the bottom of the chat
            if ($(window).scrollTop() + $(window).height() === $(document).height()) {
                $(document).scrollTop($(document).height());
            }
        });
    });

    //Broadcast messages
    $("form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/user/broadcast",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{csrf_token()}}',
                message: $("form #message").val(),
            }
        }).done(function (res) {
            $(".messages > .message").last().after(res);
            $("form #message").val('');

            // Check if user is at the bottom of the chat
            if ($(window).scrollTop() + $(window).height() === $(document).height()) {
                $(document).scrollTop($(document).height());
            }
        });
    });
</script>
@endsection