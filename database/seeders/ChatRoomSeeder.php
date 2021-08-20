<?php

namespace Database\Seeders;

use App\Models\ChatRoom;
use Illuminate\Database\Seeder;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = ['General', 'Tech Talk'];

        foreach ($rooms as $room) {
            ChatRoom::create([
                'name' => $room,
            ]);
        }
    }
}
