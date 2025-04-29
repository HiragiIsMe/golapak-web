<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => ['required'],
            'password' => ['required', 'min:8']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email Wajib Diiisi',
            'password.required' => 'Passowrd Wajib Diisi',
            'password.min' => 'Password Harus Minimal 8 Character'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'status' => 'error',
            'message' => 'Validation error',
            'errors' => $errors->messages(),
        ], 400);

        throw new HttpResponseException($response);
    }
}
