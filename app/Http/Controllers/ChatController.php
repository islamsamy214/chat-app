<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessages;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        $chat_rooms = ChatRoom::all();
        return response()->json($chat_rooms);
    } //end of rooms

    public function messages(Request $request, $room_id)
    {
        return ChatMessage::where('chat_room_id', $room_id)
            ->with('user')
            ->latest()
            ->get();
    } //end of messages

    public function newMessage(Request $request, $room_id)
    {
        $newMessage = ChatMessage::create([
            'message' => $request->message,
            'chat_room_id' => $room_id,
            'user_id' => auth()->user()->id,
        ]);

        broadcast(new NewChatMessages($newMessage))->toOthers();

        return $newMessage;
    }
}
