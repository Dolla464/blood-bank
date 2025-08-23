<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateNotificationSettingsRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationSettingsController extends Controller
{
    use ApiResponse;

    public function show(Request $request)
    {
        $client = $request->user();

        // Eager load both relationships with specific columns
        $client->load(['bloodType:id,name', 'city.governorate:id,name']);

        // Clean the pivot data from both collections
        $this->cleanPivotData($client->bloodTypes);
        $this->cleanPivotData($client->governorates);

        // Return a structured response
        return $this->apiDataResponse([
            'blood_types' => $client->bloodTypes,
            'governorates' => $client->governorates,
        ]);
    }
    public function update(UpdateNotificationSettingsRequest $request)
    {
        $client = $request->user();
        $validated = $request->validated();

        // Conditionally update blood types if the key exists in the request
        if (array_key_exists('blood_types', $validated)) {
            $client->bloodTypes()->sync($validated['blood_types']);
        }
        // Conditionally update governorates if the key exists in the request
        if (array_key_exists('governorates', $validated)) {
            $client->governorates()->sync($validated['governorates']);
        }
        // Return the full, updated state of the settings by calling the show method's logic
        return $this->show($request);
    }

    // Helper to remove the 'pivot' object from a collection.
    private function cleanPivotData($collection)
    {
        return $collection->each->setHidden(['pivot']);
    }
}