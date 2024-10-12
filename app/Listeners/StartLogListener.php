<?php

namespace App\Listeners;

use App\Events\StartLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StartLogListener
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
    public function handle(StartLogEvent $event): void
    {
        dump('Начало логирования');
    }
}
