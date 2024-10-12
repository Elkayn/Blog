<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\IndexRequest;
use App\Http\Requests\Api\Category\StoreRequest;
use App\Http\Requests\Api\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(IndexRequest $request){
        $data = $request->validated();
        $categories = Category::filter($data)->get();
        return CategoryResource::collection($categories)->resolve();
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $category = Category::create($data);
        return $category;
    }
    public function show(Category $category){
        $category = CategoryResource::make($category)->resolve();
        return $category;
    }
    public function update(Category $category, UpdateRequest $request){
        $data = $request->validated();
        $category->update($data);
        return $category;
    }
    public function destroy(Category $category){
        $category->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
