<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CommentFilter extends AbstractFilter
{
    protected array $keys = [
        'content'
    ];

    protected function content(Builder $builder, $value){
        $builder->where('content', 'ilike', "%$value%");
    }
}
