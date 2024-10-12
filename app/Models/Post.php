<?php

namespace App\Models;

use App\Http\Filters\PostFilter;
use App\Models\Traits\HasFilter;
use App\Observers\PostObserver;
use App\Traits\HasLogTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

//#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
//    use HasLogTrait;
    use HasFilter;
    protected $guarded = false;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

//    public function comments()
//    {
//        return $this->hasMany(Comment::class);
//    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function role()
    {
        return $this->profile->role();
    }

    public function like()
    {
        return $this->morphOne(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

//    public function profile()
//    {
//        return $this->morphOne(Profile::class, 'profileable');
//    }

    public function likedByProfiles()
    {
        return $this->morphToMany(Profile::class, 'likeable', 'likes');
    }

    public function getImgUrlAttribute()
    {
        return Storage::disk('public')->url($this->img_path);
    }

    public function getIsLikedAttribute()
    {
        return $this->likedByProfiles->pluck('id')->contains(auth()->user()->profile->id);
    }
}
