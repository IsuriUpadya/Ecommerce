<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow the request to proceed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'nullable|string|max:255',
            'qty' => 'nullable|integer|min:1',
            'unitprice' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'product_name.string' => 'Product name must be a string.',
            'qty.integer' => 'Quantity must be an integer.',
            'unitprice.numeric' => 'Unit price must be a number.',
        ];
    }
}
