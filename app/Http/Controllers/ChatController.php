<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
   
    public function chat()
    {
        return view('chats.chat');
    }

    public function broadcast(Request $request)
    {
        $user = Auth::user(); 
        broadcast(new MessageSent($request->get('message'),$user->image))->toOthers();

        return view('chats.broadcast', ['message' => $request->get('message'),'senderImage' => $user->image]); // Pass sender's image URL
    }

    public function receive(Request $request)
    {
        return view('chats.receive', ['message' => $request->get('message'),'senderImage' => $request->get('senderImage')]);
    }
}
