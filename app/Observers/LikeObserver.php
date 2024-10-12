<?php

namespace App\Observers;

use App\Mail\Post\LikeNotifyMail;
use App\Models\Like;
use Illuminate\Support\Facades\Mail;

class LikeObserver
{
    public function created(Like $like)
    {

    }
}
