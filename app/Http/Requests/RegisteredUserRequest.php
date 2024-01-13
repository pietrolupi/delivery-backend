<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','min:3', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'vat'=> ['required', 'string', 'max:13', 'min:13', 'unique:'.User::class]
        ];
    }

    public function messages(){
        return [
            'name.required' => 'You must provide a name',
            'name.min' => 'Your name must be at least :min characters long',
            'name.max' => 'Your name can be at most :max characters long',
            'email.required' => 'You must provide a email address',
            'email.lowercase' => 'Your email address must be in lowercase format',
            'email.email' => 'Your email address must be in email format',
            'email.max' => 'Your email address can be at most :max characters long',
            'email.unique' => 'This email address has already been registered',
            'password.required' => 'You must provide a password',
            'vat.required' => 'You must provide your VAT code',
            'vat.max', 'vat.min'=> 'Your VAT must have 13 characters',
            'vat.unique' => 'This VAT code has already been registered',

        ];
    }
}
