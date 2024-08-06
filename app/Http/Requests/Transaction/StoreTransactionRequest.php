<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'products' => 'required|array',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.product_id' => 'required|numeric|exists:product,id',
            'total_payment' => 'required|numeric|min:1',
            'total_exchange' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
        ];
    }
}
