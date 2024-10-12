<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProfileFilter;
use App\Http\Requests\Api\Profile\IndexRequest;
use App\Http\Requests\Api\Profile\StoreRequest;
use App\Http\Requests\Api\Profile\UpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(IndexRequest $request){
        $data = $request->validated();
        $profiles = Profile::filter($data)->get();
        return ProfileResource::collection($profiles)->resolve();
    }
    public function store(StoreRequest $request){
        $data = $request->validated();
        $profile = Profile::create($data);
        return $profile;
    }
    public function show(Profile $profile){
        $profile = ProfileResource::make($profile)->resolve();
        return $profile;
    }
    public function update(Profile $profile, UpdateRequest $request){
        $data = $request->validated();
        $profile->update($data);
        return $profile;
    }
    public function destroy(Profile $profile){
        $profile->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
