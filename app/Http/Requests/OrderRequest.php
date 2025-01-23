<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'total_amount' => 'nullable|numeric|min:0|max:99999999.99',
            'status' => 'required|string|in:Pending,Completed,Cancelled',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return[
            'supplier_id.required' => 'Supplier harus dipilih.',
            'supplier_id.exists' => 'Supplier yang dipilih tidak valid.',
            'order_date.required' => 'Tanggal pemesanan harus diisi.',
            'order_date.date' => 'Format tanggal pemesanan tidak valid.',
            'total_amount.numeric' => 'Total jumlah harus berupa angka.',
            'total_amount.min' => 'Total jumlah tidak boleh kurang dari 0.',
            'total_amount.max' => 'Total jumlah tidak boleh lebih dari 99,999,999.99.',
            'status.required' => 'Status pemesanan harus diisi.',
            'status.string' => 'Status pemesanan harus berupa teks.',
            'status.in' => 'Status pemesanan harus salah satu dari: Pending, Completed, atau Cancelled.',

        ];   
    }
}