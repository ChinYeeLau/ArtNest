@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Chats Management</h4>
                        <div class="chat-container">
                            <!-- Sidebar -->
                            <div class="sidebar2">
                                <ul class="contact-list">
                                    <li class="contact-item active">
                                       
                                        <img src="{{ url('admin/images/photos/no-image.png') }}" class="user-photo">
                                
                                        <div class="contact-info">
                                            <p class="contact-name" style="padding-right:50px">John Doe</p>
                                        </div>
                                    </li>
                                    <!-- Repeat for more contacts -->
                                </ul>
                            </div>
                            <!-- End Sidebar -->

                            <!-- Chat Area -->
                            <div class="chat-area">
                                <!-- Header -->
                                <div class="top">
                                  
                                        <img src="{{ url('admin/images/photos/no-image.png') }}" class="user-photo">
                                   
                                    <div  >
                                        <p style="margin-bottom:5px">John Doe</p>
                                        <small>Online</small>
                                    </div>
                                </div>
                                <!-- End Header -->

                                <!-- Chat -->
                                <div class="messages">
                                    @include('admin.chat.receive', ['message' => "Hey! What's up! "])
                                </div>
                                <!-- End Chat -->

                                <div class="bottom">
                                    <form>
                                        <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off" class="textareachat">
                                        <button type="submit" class="send-button">Send</button>
                                    </form>
                                </div>
                                <!-- End Footer -->
                            </div>
                            <!-- End Chat Area -->
                        </div>
                    </div>
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

    // Receive messages
    channel.bind('chat', function (data) {
        $.post("/admin/receive", {
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

    // Broadcast messages
    $("form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/admin/broadcast",
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
