<?php

namespace App\Listeners\Like;

use App\Events\Like\StoreEvent;
use App\Jobs\Comment\SendNotifyJob;
use App\Mail\Post\LikeNotifyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StoreListener
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
    public function handle(StoreEvent $event): void
    {

        Mail::to($event->comment->profile->profileable->email)->send(new LikeNotifyMail(auth()->user()->profile));
    }
}
