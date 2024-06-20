<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePluginRoutesRequest extends FormRequest
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
            "path" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Nama Wajib Di Isi !",
            "name.max" => "Nama Maksimal 50 Karakter !",
            "path.required" => "Rating Wajib Di Isi !",
        ];
    }
}
