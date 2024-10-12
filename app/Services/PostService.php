<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    public static function firstOrCreate(): Post
    {
        return Post::firstOrCreate([
            'title' => 'c33her'
        ], [
            'content' => 'Xalabala',
            'profile_id' => 1,
            'category_id' => 7,
            'view' => 2323,
            'is_commentable' => true
        ]);
    }

    public static function updateOrCreate($id, $data): Post
    {
        return Post::updateOrCreate(['id' => $id], $data);
    }

    public static function store($data): Post
    {
        try {
            DB::beginTransaction();

            $tagIds = TagService::storeBatch($data);
            if(isset($data['post']['tagsArray'])) {$tagsArray = $data['post']['tagsArray']; unset($data['post']['tagsArray']);}
            if(isset($data['post']['image'])) unset($data['post']['image']);
            $post = auth()->user()->profile->posts()->create($data['post']);
            $post->tags()->attach($tagIds);
//        $post->tags()->attach($tagsArray);
            DB::commit();
            $key = 'post_user_' . auth()->id();
            if(Cache::has($key)) Cache::forget($key);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return $post;
    }

    public static function update($data, $post)
    {
//        try {
//            DB::beginTransaction();
            $tagsArray = '';
            self::deleteImg($post);
            if(isset($data['tags'])) unset($data['tags']);
            if(isset($data['tagsArray'])){$tagsArray = $data['tagsArray']; unset($data['tagsArray']);}
            unset($data['_method']);
            unset($data['image']);
            unset($data['img_url']);
            unset($data['is_liked']);
            $post->update($data);
            $post->tags()->sync($tagsArray);
//            DB::commit();
            return $post;
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            return $exception->getMessage();
//        }
    }

    public static function edit($post)
    {
        $defaultTags = $post->tags->map(function ($item) {
            return $item['pivot']['tag_id'];
        })->toArray();
        return $defaultTags;
    }

    public static function destroy($post)
    {
        self::deleteImg($post);
        $post->delete();
    }

    public static function deleteImg($post)
    {
        if (isset($post->img_path))
        {
            Storage::disk('public')->delete($post->img_path);
        }
        return 0;
    }
}
