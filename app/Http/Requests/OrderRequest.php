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
            'customer_name' => 'required|string|max:50',
            'customer_address' => 'required|string|max:200',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:10',
            'total_price' => 'required|numeric',
            'products' => 'required|array',
        ];
    }

    public function messages(){
        return [
            'customer_name.required' => 'Customer name is required.',
            'customer_name.string' => 'Customer name must be a string.',
            'customer_name.max' => 'Customer name cannot exceed 50 characters.',

            'customer_address.required' => 'Customer address is required.',
            'customer_address.string' => 'Customer address must be a string.',
            'customer_address.max' => 'Customer address cannot exceed 200 characters.',

            'customer_email.required' => 'Customer email is required.',
            'customer_email.email' => 'Customer email must be a valid email address.',
            'customer_email.max' => 'Customer email cannot exceed 100 characters.',

            'customer_phone.required' => 'Customer phone number is required.',
            'customer_phone.string' => 'Customer phone number must be a string.',
            'customer_phone.max' => 'Customer phone number cannot exceed 10 characters.',

            'total_price.required' => 'Total price is required.',
            'total_price.numeric' => 'Total price must be a number.',

            'products.required' => 'Products are required.',
            'products.array' => 'Products must be provided in an array format.',
        ];
    }
}
