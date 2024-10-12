<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\PostException;
use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Api\Post\IndexRequest;
use App\Http\Requests\Api\Post\StoreRequest;
use App\Http\Requests\Api\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(IndexRequest $request){
//        $posts = PostResource::collection(Post::all())->resolve();
//        return $posts;

        $data = $request->validated();
        $posts = Post::filter($data)->get();
        return PostResource::collection($posts)->resolve();
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $post = Post::create($data);
        return $post;
    }

    public function show(Post $post)
    {
        $post = PostService::firstOrCreate();
        PostException::checkIfExists($post, 'created');
        return PostResource::make($post)->resolve();
    }

    public function update($id, UpdateRequest $request)
    {
        $data = $request->validated();
        $post = PostService::updateOrCreate($id, $data);
        PostException::checkIfExists($post, 'updated');
        return $post;
    }

    public function destroy(Post $post){
        $post->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
