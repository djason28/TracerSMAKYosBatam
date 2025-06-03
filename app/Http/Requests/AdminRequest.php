<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Otentikasi + role middleware sudah memastikan admin
    }

    public function rules(): array
    {
        $id = $this->route('admin');
        return [
            'name'     => 'required|string|max:255',
            'email'    => "required|email|unique:users,email,{$id}",
            'password' => $this->isMethod('post') ? 'required|string|min:8' : 'nullable|string|min:8',
        ];
    }
}
?>