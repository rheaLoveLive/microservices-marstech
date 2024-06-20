<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:50",
            "password" => "required|min:6",
            "email" => "required|email|unique:users",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Nama Wajib Di Isi !",
            "name.max" => "Nama Maksimal 50 Karakter !",
            "password.required" => "Password Wajib Di Isi !",
            "password.min" => "Password Minimal 6 Karakter !",
            "email.required" => "Email Wajib Di Isi !",
            "email.email" => "Email Tidak Valid",
            "email.unique" => "Email sudah digunakan",
        ];
    }
}
