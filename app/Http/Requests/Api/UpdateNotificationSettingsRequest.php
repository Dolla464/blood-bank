<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'blood_types' => 'sometimes|array',
            'blood_types.*' => 'required|integer|exists:blood_types,id',

            'governorates' => 'sometimes|array',
            'governorates.*' => 'required|integer|exists:governorates,id',
        ];
    }
    // public function messages(): array
    // {
    //     return [
    //         'blood_types.required' => 'The blood types field is required.',
    //         'governorates.required' => 'The governorates field is required.',
    //     ];
    // }
}
