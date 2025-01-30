<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah sesuai kebutuhan otorisasi
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $supplierId = $this->route('supplier');

        return [
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('suppliers', 'email') ->ignore($supplierId),

        ],
            'phone' => 'required|string|max:20|digits_between:10,15',
            'address' => 'required|string',
        ];
    }
    // 'name' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             Rule::unique('categories', 'name')->ignore($categoryId),
    //         ],

    public function messages(): array
    {
        return[
            'name.required' => 'Nama supplier harus diisi.',
            'name.string' => 'Nama supplier harus berupa teks.',
            'name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter.',
            'contact_person.required' => 'Nama kontak person harus diisi.',
            'contact_person.string' => 'Nama kontak person harus berupa teks.',
            'contact_person.max' => 'Nama kontak person tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan. Harap gunakan email lain.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'phone.digits_between' => 'Nomor telepon harus terdiri dari 10 hingga 15 digit.',
            'address.required' => 'Alamat harus diisi.',
            'address.string' => 'Alamat harus berupa teks.',
        ];
    }
}