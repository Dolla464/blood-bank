<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Client;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;
    public function register(RegisterRequest $request)
    {
        $client = Client::create($request->validated());
        $token = $client->createToken("ApiToken");
        if ($request->filled('fcm_token')) {
            $token->accessToken->fcm_token = $request->fcm_token;
            $token->accessToken->save();
        }
        $data = [
            'Client' => $client,
            'token' => $token->plainTextToken,
        ];
        return $this->apiSuccessMessage('Client Created Successfully', $data);
    }

    public function login(LoginRequest $request)
    {
        if (auth('client-web')->validate($request->only('phone', 'password'))) {
            $client = Client::where('phone', $request->phone)->first();
            if ($request->has('device_token')) {
                $client->update([
                    'device_token' => $request->device_token,
                ]);
            }
            $token = $client->createToken("ApiToken");
            if ($request->filled('fcm_token')) {
                $token->accessToken->fcm_token = $request->fcm_token;
                $token->accessToken->save();
            }
            $data = [
                'Client' => $client,
                'token' => $token->plainTextToken,
            ];
            return $this->apiSuccessMessage('Client Login Successfully', $data);
        }
        return $this->apiErrorMessage('Invalid login details');
    }
}
