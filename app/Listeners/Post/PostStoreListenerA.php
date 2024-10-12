<?php

namespace App\Listeners\Post;

use App\Events\Post\PostStoreEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostStoreListenerA
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
    public function handle(PostStoreEvent $event): void
    {
        dump('A');
    }
}
