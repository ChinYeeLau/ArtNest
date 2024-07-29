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
        <p>Ross Edlin</p>
        <small>Online</small>
      </div>
    </div>
    <!-- End Header -->
  
    <!-- Chat -->
    <div class="messages">
      @include('chats.receive', ['message' => "Hey! What's up!  👋"])
      
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
</div>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', { cluster: 'ap1' });
    const channel = pusher.subscribe('public');

    $("form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/user/broadcast",
        method: 'POST',
        data: {
            _token: '{{csrf_token()}}',
            message: $("form #message").val()
        }
    }).done(function(res) {
        console.log('Message sent:', res); // Debugging
        $(".messages").append('<div class="right message">' + res + '</div>');
        $("form #message").val('');
        scrollToBottom(); // Call the function to scroll to the bottom
    }).fail(function(xhr, status, error) {
        console.error("Failed to send message:", status, error);
    });
});

channel.bind('chat', function(data) {
    $.post("/user/receive", {
        _token: '{{csrf_token()}}',
        message: data.message,
        senderImage: data.senderImage
    }).done(function(res) {
        console.log('Received HTML:', res); // Debugging
        $(".messages").append('<div class="left message">' + res + '</div>');
        scrollToBottom(); // Call the function to scroll to the bottom
    }).fail(function(xhr, status, error) {
        console.error("Failed to receive message:", status, error);
    });
});
</script>
@endsection