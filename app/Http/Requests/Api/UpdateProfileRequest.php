<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $userId = $this->user()->id;
        return [

            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('clients')->ignore($userId)
            ],
            'phone' => [
                'required',
                'string',
                'min:11',
                Rule::unique('clients')->ignore($userId)
            ],
            'date_of_birth' => 'required|date',
            'last_donation_date' => 'nullable|date',
            'blood_type_id' => 'required|exists:blood_types,id',
            'governorate_id' => 'required|exists:governorates,id',
            'city_id' => 'required|exists:cities,id',
            'password' => 'nullable|confirmed|min:6'
        ];
    }
}
