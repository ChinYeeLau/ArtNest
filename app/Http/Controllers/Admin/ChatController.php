<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;

class ChatController extends Controller
{
    public function chat()
   
    {
        Session::put('page','chats');
        return view('admin.chat.chat');
    }

    public function broadcast(Request $request)
    {
        $admin = Auth::user(); // Get the authenticated admin
        broadcast(new MessageSent($request->get('message'),$admin->image))->toOthers();

        return view('admin.chat.broadcast', ['message' => $request->get('message'),'senderImage' => $admin->image]); // Pass sender's image URL
    }

    public function receive(Request $request)
    {
        return view('admin.chat.receive', ['message' => $request->get('message'),'senderImage' => $request->get('senderImage')]);
    }
}
