<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_title' => 'nullable|string',
            'content' => 'nullable|string',
            'profile_id' => 'nullable|integer|exists:profiles,id',
            'title' => 'nullable|string',
        ];
    }
}

