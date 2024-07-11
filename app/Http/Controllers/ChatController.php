<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('user_id', auth()->id())
            ->orWhere('vendor_id', auth()->id())
            ->with(['user', 'vendor'])
            ->get();

        foreach ($chats as $chat) {
            $chat->lastMessage = $chat->messages()
                ->when(auth()->user()->isUser(), function ($query) {
                    return $query->where('is_deleted_by_user', false);
                })
                ->when(auth()->user()->isVendor(), function ($query) {
                    return $query->where('is_deleted_by_vendor', false);
                })
                ->latest()
                ->first();
        }

        return view('chats.chat', compact('chats'));
    }

    public function show($id)
    {
        $chat = Chat::findOrFail($id);

        $messages = $chat->messages()
            ->when(auth()->user()->isUser(), function ($query) {
                return $query->where('is_deleted_by_user', false);
            })
            ->when(auth()->user()->isVendor(), function ($query) {
                return $query->where('is_deleted_by_vendor', false);
            })
            ->get();

        return view('chats.show', compact('chat', 'messages'));
    }
}
