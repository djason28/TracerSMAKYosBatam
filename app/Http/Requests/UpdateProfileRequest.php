<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'sometimes|required|string|max:255',
            'email'    => "sometimes|required|email|unique:users,email,{$this->user()->id}",
            'password' => 'nullable|string|min:8',
        ];
    }
}
?>