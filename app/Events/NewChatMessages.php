<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewChatMessages implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat_message;

    public function __construct(ChatMessage $chat_message)
    {
        $this->chat_message = $chat_message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->chat_message->chat_room_id);
    }
}
