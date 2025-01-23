<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class OrderItemRequest extends FormRequest
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
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'nullable|numeric|min:0|max:99999999.99',
            'total_price' => 'nullable|numeric|min:0|max:99999999.99',
        ];
    }

    public function messages(): array
    {
        return[
            'order_id.required' => 'Order ID harus diisi.',
            'order_id.exists' => 'Order ID yang dipilih tidak valid.',
            'product_id.required' => 'Produk harus dipilih.',
            'product_id.exists' => 'Produk yang dipilih tidak valid.',
            'quantity.required' => 'Jumlah produk harus diisi.',
            'quantity.integer' => 'Jumlah produk harus berupa bilangan bulat.',
            'quantity.min' => 'Jumlah produk tidak boleh kurang dari 1.',
            'unit_price.numeric' => 'Harga satuan harus berupa angka.',
            'unit_price.min' => 'Harga satuan tidak boleh kurang dari 0.',
            'unit_price.max' => 'Harga satuan tidak boleh lebih dari 99,999,999.99.',
            'total_price.numeric' => 'Total harga harus berupa angka.',
            'total_price.min' => 'Total harga tidak boleh kurang dari 0.',
            'total_price.max' => 'Total harga tidak boleh lebih dari 99,999,999.99.',
        ];
    }
}