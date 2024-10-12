<?php

namespace App\Services\Client;

use App\Jobs\Like\SendNotifyJob;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostService
{
    public static function storeComment($data, $post)
    {
        $data['profile_id'] = auth()->user()->getAuthIdentifier();
        $comment = $post->comments()->create($data);
        return $comment;
    }

    public static function storeAnswerComment($data, $comment)
    {
        $data['profile_id'] = auth()->user()->getAuthIdentifier();
        $answer = $comment->comments()->create($data);
        return $answer;
    }

    public static function toggleLikeComment($comment)
    {
        $res = $comment->likedByProfiles()->toggle(auth()->user()->profile->id);
        if(count($res['attached']) > 0) {
            $comment->likedByProfiles()->updateExistingPivot(auth()->user()->profile->id,
                ['created_at' => now(), 'updated_at' => now()]);
            SendNotifyJob::dispatch($comment, auth()->user()->profile);
        }
        return $res;
    }

    public static function destroy($post)
    {
        Gate::authorize('delete', $post);
        Post::destroy($post->id);
    }
}
