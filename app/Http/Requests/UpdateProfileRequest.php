<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[A-zA-Z\s]+$/u',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Wajib Diisi',
            'name.regex' => 'Nama Wajib Huruf Alphabet',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Wajib Format Email',
        ];
    }
}
