<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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

        $categoryId = $this->route('id'); //

        // $categoryId = $categoryId ? $categoryId : '';

        return [
            // 'name' => 'required|string|max:255|unique:categories,name,' . $id, // Abaikan kategori dengan ID ini
            // 'description' => 'nullable|string',
            

            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($categoryId),
            ],
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => 'Nama kategori harus diisi.',
            'name.string' => 'Nama kategori harus berupa teks.',
            'name.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'name.unique' => 'Nama kategori sudah digunakan. Harap pilih nama yang lain.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ];
    }
}