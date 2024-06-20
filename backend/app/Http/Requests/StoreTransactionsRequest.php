<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionsRequest extends FormRequest
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
            "tgl_trans" => "required",
            "gtotal_trans" => "required|numeric",
            "diskon_trans" => "required|numeric",
            "pay_trans" => "required|numeric",
            "type_payment_trans" => "required",
            "number_card_trans" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "tgl_trans.required" => "Tanggal Wajib Di Isi !",
            "gtotal_trans.required" => "Total Wajib Di Isi !",
            "diskon_trans.required" => "Diskon Wajib Di Isi !",
            "pay_trans.required" => "Pay Wajib Di Isi !",
            "type_payment_trans.required" => "Type Harus Di isi !",
            "number_card_trans.required" => "No Harus Di isi !",
        ];
    }
}
