<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use App\Traits\HasLogTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
//    use HasLogTrait;
    use HasFilter;
    protected $guarded = false;

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
