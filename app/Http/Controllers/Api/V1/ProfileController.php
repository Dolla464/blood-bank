<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\Api\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $client = $request->user();

        $client->load(['bloodType', 'city.governorate']);

        return response()->json([
            'message'=>'Profile data fetched successfully',
            'data'=>new ClientResource($client)
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $client = $request->user();

        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }
        $client->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => new ClientResource($client->load(['bloodType', 'city.governorate']))
        ]);
    }
}
