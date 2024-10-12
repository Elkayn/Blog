<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    /**
     * Create a new class instance.
     */
    public static function storeBatch($data)
    {
        $tags = explode(',', $data['tags']);
        $tagIds = [];
        foreach ($tags as $tagTitle) {
            $tagIds[] = Tag::firstOrCreate([
                'title' => $tagTitle,
                'description' => $tagTitle
            ])->id;
        }
        return $tagIds;
    }
}
