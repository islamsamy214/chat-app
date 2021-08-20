<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['chat_room_id', 'user_id', 'message'];

    public function room()
    {
        return $this->belongsTo(ChatRoom::class);
    } //end of chatRoom relation

    public function user()
    {
        return $this->belongsTo(User::class);
    } //end of user relation 
}
