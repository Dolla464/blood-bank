<?php

namespace App\Traits;

trait ApiResponse
{
    public function apiResponse($status, $message = null, $data = [], $responseCode = 200)
    {
        $data = [
            'status' => $status,
            'message' => $message,
            'data' =>$data
        ];
        return response()->json($data ,$responseCode);
    }

    public function apiDataResponse($data)
    {
        return $this->apiResponse('success', 'Data retrieved successfully', $data);
    }

    public function apiSuccessMessage($message, $data = [])
    {
        return $this->apiResponse('success', $message, $data);
    }

    public function apiErrorMessage($message, $data = [])
    {
        return $this->apiResponse('error', $message, $data, 400);
    }
}