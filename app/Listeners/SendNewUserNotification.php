<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewUserNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle($event)
    // {
    //     $admins = User::where('id', 1)->get();

    //     Notification::send($admins, new Send_Notification($event->user));
    // }
}
