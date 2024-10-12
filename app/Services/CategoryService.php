<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public static function store($data)
    {
        $category = Category::create($data['category']);
        $key = 'category_user_' . auth()->id();
        if(Cache::has($key)) Cache::forget($key);
        return $category;
    }
}
