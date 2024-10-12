<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
        TagResource::collection($tags)->resolve();

        return inertia('Admin/Tag/index', compact('tags'));
    }
    public function store(){
        $data = $this->getData();
        $tag = Tag::create($data);
        return $tag;
    }

    public function update(Tag $tag){
        $tag->update([
            'title' => 'ИЮНЬ2024'
        ]);
        return $tag;
    }
    public function destroy(Tag $tag){
        $tag->delete();
        return "Успех";
    }
    public function show(Tag $tag){
        $tag = TagResource::make($tag)->resolve();
        return $tag;
    }
    public function getData(){
        $data = [
            'title' => 'ЛЕТО2024',
            'description' => 'Время года'
        ];
        return $data;
    }
}
