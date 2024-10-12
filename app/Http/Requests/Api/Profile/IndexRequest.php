<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role_title' => 'nullable|string',
            'age' => 'nullable|integer',
            'phone' => 'nullable|string',
            'third_name' => 'nullable|string',
            'second_name' => 'nullable|string',
            'first_name' => 'nullable|string',
        ];
    }
}
