<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddonsRequest extends FormRequest
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
            "category" => "required|max:10",
            "price" => "required|numeric",
            // "foto_icon" => "mimes:jpg,jpeg,png|max:1024",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Nama Wajib Di Isi !",
            "name.max" => "Nama Maksimal 50 Karakter !",
            "category.required" => "Kategori Wajib Di Isi !",
            "category.max" => "Kategori Maksimal 10 Karakter !",
            "price.required" => "Harga Wajib Di Isi !",
            "price.numeric" => "Harga Harus Berupa Angka !",
            // "icon.required" => "Icon Wajib Di Isi !",
            // "icon.mimes" => "Icon Harus Berupa JPG, JPEG, PNG !",
            // "icon.max" => "Icon Maksimal 1024 KB !",
        ];
    }
}
