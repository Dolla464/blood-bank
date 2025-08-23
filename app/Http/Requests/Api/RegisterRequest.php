<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'city_id' => 'required|exists:cities,id',
            'phone' => [
                'required',
                'unique:clients,phone',
                'regex:/^01[0-9]{9}$/'  // Egyptian phone number pattern
            ],
            'password' => 'required|min:6|confirmed',
            'blood_type_id' => 'required|exists:blood_types,id',
            'date_of_birth' => 'required|date',
            'last_donation_date' => 'required|date',
            'fcm_token' => 'nullable|string|max:255',
        ];
    }
}
