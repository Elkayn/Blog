<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostFilter extends AbstractFilter
{
    protected array $keys = [
        'category_title',
        'content',
        'profile_id',
        'title',
    ];

    protected function categoryTitle(Builder $builder, $value){
         $builder->whereRelation('category', 'title', 'ilike', "%$value%");
    }

    protected function title(Builder $builder, $value){
        $builder->where('title', 'ilike', "%$value%");
    }

    protected function content(Builder $builder, $value){
        $builder->where('content', 'ilike', "%$value%");
    }

    protected function profileId(Builder $builder, $value){
        $builder->where('profile_id', 'ilike', "$value");
    }
}
