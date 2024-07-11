@extends('layouts.app')

@section('content')
    <h1>Chat</h1>
    <ul>
        @foreach($messages as $message)
            <li>{{ $message->sender->name }}: {{ $message->content }}</li>
        @endforeach
    </ul>
    <form method="POST" action="{{ route('messages.store', $chat->id) }}">
        @csrf
        @method('PUT')
        <textarea name="content"></textarea>
        <button type="submit">Send</button>
    </form>
@endsection