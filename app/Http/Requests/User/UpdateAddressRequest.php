<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateAddressRequest extends FormRequest
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
            'id' => 'required',
            'user_id' => 'required',
            'name' => ['required', 'max:50'],
            'phone_number' => ['required', 'max:20'],
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'main_address' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'id.required' => 'Id Wajib Diisi',
            'name.required' => 'Nama Wajib Diisi',
            'name.max' => 'Maksimal Karakter Nama Adalah 50',
            'phone_number.required' => 'Nomor Handphone Wajib Diisi',
            'phone_number.max' => 'Maksimal Karakter Nomor Handphone Adalah 20',
            'address.required' => 'Alamat Wajib Diisi',
            'longitude.required' => 'Informasi Maps Wajib Diisi',
            'latitude.required' => 'Informasi Maps Wajib Diisi',
            'main_address.required' => 'Alamat Utama Wajib Diisi'
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

