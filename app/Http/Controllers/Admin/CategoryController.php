<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\StoreCacheRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        CategoryResource::collection($categories)->resolve();

        return inertia('Admin/Category/Index', compact('categories'));
    }

    public function create()
    {
        $key = 'category_user_' . auth()->id();
        $cache = Cache::get($key);
        return inertia('Admin/Category/Create', compact('cache'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $category = CategoryService::store($data);
        return CategoryResource::make($category)->resolve();
    }

    public function storeCache(StoreCacheRequest $request)
    {
        $data = $request->validated();
        $key = 'category_user_' . auth()->id();
        Cache::put($key, $data);
    }

    public function edit(Category $category)
    {
        $category = CategoryResource::make($category)->resolve();
        return inertia('Admin/Category/Edit', compact('category'));
    }

    public function update(Category $category, UpdateRequest $request)
    {
        $data = $request->validated();
        $category->update($data);
        return CategoryResource::make($category)->resolve();
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
