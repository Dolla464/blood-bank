<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreDonationRequest;
use App\Http\Resources\Api\DonationRequestResource;
use App\Jobs\SendDonationNotificationJob;
use App\Models\DonationRequest;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationRequestController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $request->validate([
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'governorate_id' => 'nullable|exists:governorates,id',
        ]);

        $query = DonationRequest::with(['city.governorate', 'bloodType']);

        if ($request->filled('blood_type_id')) {
            $query->where('blood_type_id', $request->blood_type_id);
        }
        if ($request->filled('governorate_id')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('governorate_id', $request->governorate_id);
            });
        }

        $donations = $query->latest()->paginate(10);

        return $this->apiSuccessMessage(
            'Donation requests retrieved successfully.',
            DonationRequestResource::collection($donations)
        );
    }

    public function show($id)
    {
        try {
            $donation = DonationRequest::findOrFail($id);
            return new DonationRequestResource($donation);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Donation request not found.'
            ], 404);
        }
    }

    public function store(StoreDonationRequest $request)
    {
        // Validate and get all request
        $data = $request->validated();
        // Attach the authenticated client's ID
        $data['client_id'] = Auth::id();

        $donationRequest = DonationRequest::create($data);

        SendDonationNotificationJob::dispatch($donationRequest);

        return $this->apiSuccessMessage(
            'Donation Request Created Successfully. Notifications are being sent.....',
            ['donation_request' => new DonationRequestResource($donationRequest)],
            201
        );
    }
}
