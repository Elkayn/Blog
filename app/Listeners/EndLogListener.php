<?php

namespace App\Listeners;

use App\Events\EndLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EndLogListener
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
    public function handle(EndLogEvent $event): void
    {
        dump('Конец логирования');
    }
}
