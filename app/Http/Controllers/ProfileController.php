<?php

namespace App\Http\Controllers;

use App\Events\Like\StoreEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\Post\PostWithCommentResource;
use App\Http\Resources\PostResource;
use App\Jobs\Like\SendNotifyJob;
use App\Models\Comment;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = PostResource::collection(Post::all())->resolve();
        return inertia('Profile/Index', compact('posts'));
    }

    public function toggleLike(Post $post)
    {
        $res = $post->likedByProfiles()->toggle(auth()->user()->profile->id);
        if(count($res['attached']) > 0) {
            $post->likedByProfiles()->updateExistingPivot(auth()->user()->profile->id,
                ['created_at' => now(), 'updated_at' => now()]);
        }
        return response()->json([
            'is_liked' => count($res['attached']) > 0
        ]);
    }
}
