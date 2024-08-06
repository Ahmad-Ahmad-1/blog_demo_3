<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:50'],
            'caption' => ['required', 'string'],
            'img' => ['nullable', 'image']
        ];
    }
}
