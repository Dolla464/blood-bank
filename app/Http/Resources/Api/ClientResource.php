<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'date_of_birth' => $this->date_of_birth,
            'last_donation_date' => $this->last_donation_date,
            'blood_type' => new BloodTypeResource($this->whenLoaded('bloodType')),
            'city' => new CityResource($this->whenLoaded('city')),
        ];
    }
}
