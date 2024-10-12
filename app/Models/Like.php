<?php

namespace App\Models;

use App\Observers\LikeObserver;
use App\Traits\HasLogTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(LikeObserver::class)]
class Like extends Model
{
    use HasFactory;
//    use HasLogTrait;
    protected $guarded = false;
}
