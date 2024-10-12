<?php

namespace App\Observers;

use App\Jobs\Comment\SendNotifyJob;
use App\Mail\Post\SendNotifyMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class CommentObserver
{
    public function created(Comment $comment)
    {
        SendNotifyJob::dispatch($comment);
    }
}
