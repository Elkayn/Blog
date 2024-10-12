<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProfileFilter extends AbstractFilter
{
    protected array $keys = [
        'role_title',
        'age',
        'phone',
        'third_name',
        'second_name',
        'first_name',
    ];

    protected function roleTitle(Builder $builder, $value){
        $builder->whereRelation('role', 'title', 'ilike', "%$value%");
    }

    protected function age(Builder $builder, $value){
        $builder->where('age', 'ilike', $value);
    }

    protected function phone(Builder $builder, $value){
        $builder->where('phone', 'ilike', "%$value%");
    }

    protected function thirdName(Builder $builder, $value){
        $builder->where('third_name', 'ilike', "%$value%");
    }

    protected function secondName(Builder $builder, $value){
        $builder->where('second_name', 'ilike', "%$value%");
    }

    protected function firstName(Builder $builder, $value){
        $builder->where('first_name', 'ilike', "%$value%");
    }
}
