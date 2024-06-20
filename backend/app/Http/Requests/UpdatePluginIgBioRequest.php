<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePluginIgBioRequest extends FormRequest
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
            "nama" => "required|max:50",
            "email" => "required|email|unique:plugin_ig_bios",
            "alamat" => "required|max:100",
            "no_hp" => "required|max:13",
            "agama" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            "nama.required" => "Nama Wajib Di Isi !",
            "nama.max" => "Nama Maksimal 50 Karakter !",
            "alamat.required" => "Kategori Wajib Di Isi !",
            "alamat.max" => "Kategori Maksimal 100 Karakter !",
            "email.required" => "Email Wajib Di Isi !",
            "email.email" => "Email Tidak Valid",
            "email.unique" => "Email sudah digunakan",
            "agama.required" => "Email Wajib Di Isi !",
            "no_hp.required" => "Email Wajib Di Isi !",
            "no_hp.max" => "Kategori Maksimal 13 Karakter !",
        ];
    }
}
