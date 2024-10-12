<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Traits\HasLogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    use HasLogTrait;
    use HasFilter;
    protected $guarded = false;

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function profileable(){
        return $this->morphTo();
    }

    public function likedPosts(){
        return $this->morphedByMany(Post::class, 'likeable', 'likes');
    }

    public function likedComments(){
        return $this->morphedByMany(Comment::class, 'likeable', 'likes');
    }
}
