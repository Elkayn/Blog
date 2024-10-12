<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

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
            'first_name' => 'nullable',
            'second_name' => 'required',
            'third_name' => 'required',
            'phone' => 'nullable',
            'age' => 'required',
            'user_id' => 'nullable',
            'role_id' => 'required'
        ];
    }
}
