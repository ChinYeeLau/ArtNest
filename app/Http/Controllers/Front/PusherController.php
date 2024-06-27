<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;

class PusherController extends Controller
{
    public function chat()
    {
        return view('front.pusher.chat');
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();
        return view('front.pusher.broadcast', ['message' =>$request->get('message')]);
    }

    public function receive(Request $request)
    {
        return view('front.pusher.receive', ['message' => $request->get('message')]);
    }

}
