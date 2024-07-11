@extends('layouts.app')

@section('content')
    <h1>Chats</h1>
    <ul>
        @foreach($chats as $chat)
            <li>
                <a href="{{ route('chats.show', $chat->id) }}">
                    Chat with {{ $chat->user->name }} or {{ $chat->vendor->name }}
                    (Last message: {{ $chat->lastMessage->content ?? 'No messages yet' }})
                </a>
            </li>
        @endforeach
    </ul>
@endsection