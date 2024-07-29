<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public ?string $senderImage;

    public function __construct(string $message, ?string $senderImage = null)
    {
        $this->message = $message;
        $this->senderImage = $senderImage;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('public');
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
