<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;

class PusherController extends Controller
{
    public function userChat()
    {
        return view('front.pusher.userchat');
    }

    public function userBroadcast(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        broadcast(new PusherBroadcast($request->message))->toOthers();
        return view('front.pusher.userboardcast', ['message' => $message]);
    }

    public function userReceive(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        return view('front.pusher.userreceive', ['message' => $request->message]);
    }

}
