<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        CommentResource::collection($comments)->resolve();

        return inertia('Admin/Comment/index', compact('comments'));
    }
    public function store(){
        $data = $this->getData();
        $comment = Comment::create($data);
        return $comment;
    }

    public function update(Comment $comment){
        $comment->update([
            'content' => 'Товар не соответствует описанию'
        ]);
        return $comment;
    }
    public function destroy(Comment $comment){
        $comment->delete();
        return "Успех";
    }
    public function show(Comment $comment){
        $comment = CommentResource::make($comment)->resolve();
        return $comment;
    }
    public function getData(){
        $data = [
            'content' => 'Товар говно',
            'author_id' => '2',
            'post_id' => '11',
            'status' => 'Опубликован'
        ];
        return $data;
    }
}
