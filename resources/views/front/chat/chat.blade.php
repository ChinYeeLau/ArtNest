@extends('front.layout.layout')
@section('content')
<div class="container py-5 h-100">
    <div class="container-fluid py-5 mt-5" >
        <div class="chat-wrapper">

        <div class="chat-container" >
            <!-- Sidebar -->
            <div class="sidebar" style="padding:0px ">
                    <!-- Example contact item -->
                    <li class="contact-item active" style="list-style-type: none;display:flex; padding:10px;border-radius: 10px 0 0 0; ">
                        <span class="material-symbols-outlined icon" style="width:50px"> person </span>   
                        <div class="contact-info">
                            <p class="contact-name">John Doe</p>
                        </div>
                    </li>
                    <!-- Add more contact items here -->
              
            </div>

            <!-- Chat Area -->
            <div class="chat-area">
                <!-- Header -->
                <div class="top"  style="padding:4px">
                        <span class="material-symbols-outlined icon"> person </span>
                    <div>
                        <p style="color:black;padding-top:10px;margin-bottom:5px;padding-left:10px;">John Doe</p>
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
                <div class="bottom" >
                    <form>
                        <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off" class="textareachat">
                        <button type="submit" class="send-button">Send</button>
                    </form>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </div>
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
