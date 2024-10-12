<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\IndexRequest;
use App\Http\Requests\Api\Comment\StoreRequest;
use App\Http\Requests\Api\Comment\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(IndexRequest $request){
        $data = $request->validated();
        $comments = Comment::filter($data)->get();
        return CommentResource::collection($comments)->resolve();
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $comment = Comment::create($data);
        return $comment;
    }
    public function show(Comment $comment){
        $comment = CommentResource::make($comment)->resolve();
        return $comment;
    }
    public function update(Comment $comment, UpdateRequest $request){
        $data = $request->validated();
        $comment->update($data);
        return $comment;
    }
    public function destroy(Comment $comment){
        $comment->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
