<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationRequestResource extends JsonResource
{

  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'patient_name' => $this->patient_name,
      'patient_age' => $this->patient_age,
      'blood_type_id' => $this->blood_type_id,
      'blood_type_name' => optional($this->bloodType)->name,
      'bags_number' => $this->bags_number,
      'hospital_address' => $this->hospital_address,
      'latitude' => $this->latitude,
      'longitude' => $this->longitude,
      'city_id' => $this->city_id,
      'city_name' => optional($this->city)->name,
      'governorate_name' => optional($this->city?->governorate)->name,
      'client_id' => $this->client_id,
      'patient_phone' => $this->patient_phone,
      'notes' => $this->notes,
      'status' => $this->status,
    ];
  }
}
