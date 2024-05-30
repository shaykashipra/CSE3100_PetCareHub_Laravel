<?
// app/Providers/EventServiceProvider.php
namespace App\Providers;

use App\Events\PetAdded;
use App\Listeners\SendPetAddedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PetAdded::class => [
            SendPetAddedNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
