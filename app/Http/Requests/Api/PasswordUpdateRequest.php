<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'current_password:sanctum'],
            'new_password' => [
                'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised(),
            ]
        ];
    }
}
