<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\PetAdded;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PetAddedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPetAddedNotification 
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  PetAdded  $event
     * @return void
     */
    public function handle(PetAdded $event)
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new PetAddedNotification($event->pet));
        }
    }
}