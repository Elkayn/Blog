<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Traits\HasLogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
//    use HasLogTrait;
    use HasFilter;
    protected $guarded = false;

//    protected static function booted(){
//        static::created(function (Category $category){
//            dump(4242);
//        });
//    }
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasManyThrough(Comment::class, Post::class);
    }
}
