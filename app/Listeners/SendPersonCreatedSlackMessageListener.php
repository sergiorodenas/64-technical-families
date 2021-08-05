<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewPersonSlackMessage;
use App\Notifications\PersonCreatedSlackMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class SendPersonCreatedSlackMessageListener
{
    public function handle($event)
    {
        rescue(fn() =>
            User::where('email', 'admin@admin.test')->firstOrFail()->notify(new PersonCreatedSlackMessage($event->person))
        );
    }
}
