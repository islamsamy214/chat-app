<?php

namespace App\Listeners;

use App\Events\NewChatMessages;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChatMessageNotification
{
    
    public function __construct()
    {
        //
    }

    
    public function handle(NewChatMessages $event)
    {
        //
    }
}
