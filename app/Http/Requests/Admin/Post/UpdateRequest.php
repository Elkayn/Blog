<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable',
            'category_id' => 'required|integer|exists:categories,id',
            'view' => 'required|integer',
            'is_commentable' => 'required|string|in:true,false',
            'publish_at' => 'required',
            'tagsArray' => ''
        ];
    }

    protected function passedValidation()
    {
        return $this->merge([
            'img_path' => Storage::disk('public')->put('images', $this->image)
        ]);
    }
}
