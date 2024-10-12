<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post.title' => 'required|string',
            'post.content' => 'required|string',
            'post.image' => 'nullable',
            'post.category_id' => 'required|integer|exists:categories,id',
            'post.view' => 'required|integer',
            'post.is_commentable' => 'required|string|in:true,false',
            'post.publish_at' => 'required',
            'tagsArray' => '',
            'tags' => 'nullable|string'
        ];
    }

    protected function passedValidation()
    {
        if(isset($this->post['image'])) {
            return $this->merge([
                'post' => array_merge($this->post, ['img_path' => Storage::disk('public')->putFile('images', $this->post['image'])])
            ]);
        } return $this->post();
    }
}
