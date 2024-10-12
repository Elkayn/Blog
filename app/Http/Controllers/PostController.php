<?php

namespace App\Http\Controllers;


use App\Http\Requests\Post\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\Client\PostService;
use \Illuminate\Support\Facades\Gate;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Post/Show', compact('post'));
    }

    public function storeComment(Post $post, StoreCommentRequest $request)
    {
        $data = $request->validated();
        $comment = PostService::storeComment($data, $post);
        return CommentResource::make($comment)->resolve();
    }

    public function storeAnswerComment(Comment $comment, StoreCommentRequest $request)
    {
        $data = $request->validated();
        $answer = PostService::storeAnswerComment($data, $comment);
        return CommentResource::make($answer)->resolve();
    }

    public function showComments(Post $post)
    {
        $comments = $post->comments()->get();
        return CommentResource::collection($comments)->resolve();
    }

    public function showAnswers(Comment $comment)
    {
        $comments = $comment->comments()->get();
        return CommentResource::collection($comments)->resolve();
    }

    public function toggleLikeComment(Comment $comment)
    {
        $res = PostService::toggleLikeComment($comment);
        return response()->json([
            'is_liked' => count($res['attached']) > 0
        ]);
    }

    public function destroy(Post $post)
    {
        PostService::destroy($post);
        return PostResource::collection(Post::all())->resolve();
    }
}
