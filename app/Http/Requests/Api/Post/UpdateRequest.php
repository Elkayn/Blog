<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "nullable",
            "content" => "nullable",
            "profile_id" => "nullable",
            "category_id" => "nullable",
            "view" => "nullable",
            "is_commentable" => "nullable",
            "publish_at" => "nullable"
        ];
    }
}
