<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Chat $chat)
    {
        $message = $chat->messages()->create([
            'sender_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return response()->json($message);
    }
   

    public function destroy(Message $message)
    {
        if (auth()->user()->isUser()) {
            $message->update(['is_deleted_by_user' => true]);
        } elseif (auth()->user()->isVendor()) {
            $message->update(['is_deleted_by_vendor' => true]);
        }

        return response()->json(['success' => true]);
    }
}
