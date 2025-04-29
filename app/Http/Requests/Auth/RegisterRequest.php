<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'name' => ['required', 'max:50'],
            'email' => ['required', 'unique:users,email'],
            'phone_number' => ['required', 'unique:users,phone_number'],
            'password' => ['required', 'min:8'] 
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'Nama Wajib Diisi',
            'name.max' => 'Maksimal Karakter Nama Adalah 50',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Telah Digunakan',
            'email.regex' => 'Email harus berformat .polije.ac.id',
            'phone_number.required' => 'Nomor Handphone Wajib Diisi',
            'phone_number.unique' => 'Nomor Handphone Telah Digunakan',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Minimal Karakter Password Adalah 8'
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
