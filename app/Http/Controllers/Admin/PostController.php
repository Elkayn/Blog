<?php

namespace App\Http\Controllers\Admin;

use App\Events\Like\StoreEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\IndexRequest;
use App\Http\Requests\Admin\Post\StoreCacheRequest;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(IndexRequest $request){
        $data = $request->validationData();
        $posts = PostResource::collection(Post::filter($data)->paginate(5, ['*'], 'page', $data['page']));

        if($request->wantsJson())
            return $posts;
        return inertia('Admin/Post/index', compact('posts'));
    }

    public function create()
    {
        $key = 'post_user_' . auth()->id();
        $cache = Cache::get($key);
        $categories = CategoryResource::collection(Category::all())->resolve();
        $tags = TagResource::collection(Tag::all())->resolve();
        return inertia('Admin/Post/create', compact('categories', 'tags', 'cache'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validationData();
        $post = PostService::store($data);
        return PostResource::make($post)->resolve();
    }

    public function edit(Post $post)
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $tags = TagResource::collection(Tag::all())->resolve();
        $defaultTags = PostService::edit($post);
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Edit', compact('post', 'categories', 'tags', 'defaultTags'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validationData();
        $post = PostService::update($data, $post);
        return PostResource::make($post)->resolve();
    }

    public function destroy(Post $post, IndexRequest $request){
        $data = $request->validationData();
        PostService::destroy($post);
    }

    public function show(Post $post)
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Show', compact('post', 'categories'));
    }

    public function storeCache(StoreCacheRequest $request)
    {
        $data = $request->validated();
        $key = 'post_user_' . auth()->id();
        Cache::put($key, $data);
    }
}
