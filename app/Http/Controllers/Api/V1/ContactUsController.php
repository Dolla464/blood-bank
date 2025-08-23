<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;
use App\Models\Contact;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    use ApiResponse;
    public function storeMessage(ContactUsRequest $request)
    {
        /** @var \App\Models\Client $client */
        
        $client = Auth::guard('api')->user();
        $message = $client->messages()->create([
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return $this->apiDataResponse($message);
    }
}
