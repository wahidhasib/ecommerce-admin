<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'     => 'required|string|max:40',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Name field is required',
            'name.string'       => 'Use only valid characters for your name.',
            'name.max'          => 'Name must not be longer than :max characters.',
            'email.required'    => 'Email field is required.',
            'email.email'       => 'Enter a valid email.',
            'email.unique'      => 'This email is already registered. Please use another one.',
            'password.required' => 'Password field is required.',
            'password.min'      => 'Password must be at least :min characters.',
        ];
    }
}
