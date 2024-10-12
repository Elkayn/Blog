<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Observers\CommentObserver;
use App\Traits\HasLogTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(CommentObserver::class)]
class Comment extends Model
{
    use HasFactory;
//    use HasLogTrait;
    use HasFilter;

    protected $guarded = false;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function category(){
        return $this->post->category();
    }

    public function commentable(){
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likedByProfiles(){
        return $this->morphToMany(Profile::class, 'likeable', 'likes');
    }

    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getIsLikedAttribute()
    {
        return $this->likedByProfiles->pluck('id')->contains(auth()->user()->profile->id);
    }
}
