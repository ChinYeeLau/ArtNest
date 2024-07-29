<?php

namespace App\Http\Controllers\Front;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat()
    {
        return view('front.chat.chat');
    }

    public function broadcast(Request $request)
    {
        $user = Auth::user(); 
        broadcast(new MessageSent($request->get('message'),$user->image))->toOthers();

        return view('front.chat.broadcast', ['message' => $request->get('message'),'senderImage' => $user->image]); // Pass sender's image URL
    }

    public function receive(Request $request)
    {
        return view('front.chat.receive', ['message' => $request->get('message'),'senderImage' => $request->get('senderImage')]);
    }
}
