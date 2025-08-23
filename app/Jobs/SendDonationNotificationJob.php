<?php

namespace App\Jobs;

use App\Models\Client;
use App\Models\DonationRequest;
use App\Notifications\DonationRequestCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// Make sure to import the Log facade!
use Illuminate\Support\Facades\Log;

class SendDonationNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $donationRequest;

    public function __construct(DonationRequest $donationRequest)
    {
        $this->donationRequest = $donationRequest;
    }

    public function handle()
    {
        Log::info("Starting SendDonationNotificationJob for Donation Request ID: {$this->donationRequest->id}");

        // Eager load the relationship
        $this->donationRequest->load('city');

        // Check if the city and governorate relationship is loaded correctly
        if (!$this->donationRequest->city) {
            Log::error("Donation Request ID {$this->donationRequest->id} does not have a valid city.");
            return;
        }
        $targetGovernorateId = $this->donationRequest->city->governorate_id;
        $targetBloodTypeId = $this->donationRequest->blood_type_id;

        Log::info("Searching for clients with Blood Type ID: {$targetBloodTypeId} and Governorate ID: {$targetGovernorateId}");

        // Find eligible clients
        $clientQuery = Client::whereHas('bloodTypes', function ($query) use ($targetBloodTypeId) {
            $query->where('blood_type_id', $targetBloodTypeId);
        })->whereHas('governorates', function ($query) use ($targetGovernorateId) {
            $query->where('governorate_id', $targetGovernorateId);
        });

        // Log the raw SQL to be sure
        Log::info('Client Search SQL: ' . $clientQuery->toSql());

        $clientIds = $clientQuery->pluck('id')->toArray();

        // THIS IS THE MOST IMPORTANT LOG
        Log::info("Found " . count($clientIds) . " matching clients.", ['client_ids' => $clientIds]);

        if (empty($clientIds)) {
            Log::warning("No clients found matching the criteria. Job finished.");
            return; // This is likely where your code is stopping
        }

        // Create the notification record
        $notification = $this->donationRequest->notifications()->create([
            'title' => 'New Donation Request',
            'message' => "A new donation request is available in your area.",
        ]);
        Log::info("Created notification record with ID: {$notification->id}");

        // Attach the clients to the notification
        $notification->clients()->attach($clientIds);
        Log::info("Attached " . count($clientIds) . " clients to notification ID: {$notification->id}. Job complete.");

        //fcm
        $clients = $clientQuery->get();
        foreach($clients as $client){
            $client->notify(new DonationRequestCreated($notification));
        }
    }
}