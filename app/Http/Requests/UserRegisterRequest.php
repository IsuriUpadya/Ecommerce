<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Allow this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ecommerce_users')->where(function ($query) {
                    return $query->where('email', $this->email);
                }),
            ],
            'email' => 'required|email|max:255|unique:ecommerce_users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => [
                'required',
                'string',
                Rule::in(['admin', 'user']),
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'The combination of username and email already exists.',
            'email.unique' => 'The email is already registered.',
        ];
    }
}

