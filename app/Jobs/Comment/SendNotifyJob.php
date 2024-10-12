<?php

namespace App\Jobs\Comment;

use App\Mail\Post\SendNotifyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $comment)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->comment->commentable_type == 'App\Models\Post') {
            Mail::to($this->comment->commentable->profile->profileable->email)->send(new SendNotifyMail($this->comment));
        }   else {
            Mail::to($this->comment->commentable->profile->profileable->email)->send(new SendNotifyMail($this->comment));
        }
    }
}
