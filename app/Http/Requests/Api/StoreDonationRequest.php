<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
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
            'patient_name' => 'required|string|max:255',
            'patient_age' => 'required|integer|min:16|max:65',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_number' => 'required|integer|min:1|max:10',
            'hospital_address' => 'required|string|max:255',
            'governorate_id' => 'required|exists:governorates,id',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => [
                'required',
                'unique:clients,phone',
                'regex:/^01[0-9]{9}$/'  // Egyptian phone number pattern
            ],
            'notes' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ];
    }
}
