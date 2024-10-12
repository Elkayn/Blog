<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\IndexRequest;
use App\Http\Requests\Api\Tag\StoreRequest;
use App\Http\Requests\Api\Tag\UpdateRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(IndexRequest $request){
        $data = $request->validated();
        $tags = Tag::filter($data)->get();
        return TagResource::collection($tags)->resolve();
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $tag = Tag::create($data);
        return $tag;
    }
    public function show(Tag $tag){
        $tag = TagResource::make($tag)->resolve();
        return $tag;
    }
    public function update(Tag $tag, UpdateRequest $request){
        $data = $request->validated();
        $tag->update($data);
        return $tag;
    }
    public function destroy(Tag $tag){
        $tag->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
