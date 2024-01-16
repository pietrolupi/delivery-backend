<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "name" => "required|min:2|max:255",
            "ingredients" => "required|min:2|max:255",
            "description" => "max:400",
            "price"=> "required|numeric|between:0,9999",
            "image"=> "image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'",

        ];

    }
    public function messages()
{
    return [
        'name.required' => 'The name field is required.',
        'name.min' => 'The name field must be at least :min characters.',
        'name.max' => 'The name field cannot exceed :max characters.',

        'ingredients.required' => 'The ingredients field is required.',
        'ingredients.min' => 'The ingredients field must be at least :min characters.',
        'ingredients.max' => 'The ingredients field cannot exceed :max characters.',

        'description.max' => 'The description field cannot exceed :max characters.',

        'price.required' => 'The price field is required.',
        'price.numeric' => 'The price field must be a number.',
        'price.between' => 'The price field must be between :min and :max.',

        'image.image' => 'The image field must be an image file.',
        'image.mimes' => 'The image field must be a file of type: :mimes.',
        'image.max' => 'The image field cannot exceed 2048 kilobytes.',
    ];
}

}
