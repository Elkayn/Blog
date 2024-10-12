<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

class Analitic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analitic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $res['count_posts'] = Post::where('created_at', '>', now()->toDateString())->count();
        $res['count_comments'] = Comment::where('created_at', '>', now()->toDateString())->count();
        $res['count_likes_posts'] = Like::where('created_at', '>', now()->toDateString())->where('likeable_type', 'App\Models\Post')->count();
        $res['count_likes_comments'] = Like::where('created_at', '>', now()->toDateString())->where('likeable_type', 'App\Models\Comment')->count();
        $res['date'] = now()->toDateString();
        \App\Models\Analitic::UpdateOrCreate(['date' => $res['date']], $res);
    }
}
