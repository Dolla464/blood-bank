<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $client = $request->user();

        $notifications = $client->notifications()
        ->with('clients')
        ->orderBy('client_notification.created_at', 'desc')
        ->get()
        ->map(function ($notification){
            return [
                'id' => $notification->id,
                'title' => $notification->title,
                'message' => $notification->message,
                'is_read' => $notification->pivot->is_read,
                'date' => $notification->pivot->created_at->format('Y-m-D H:i'),
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $notifications
        ]);

    }

    public function markAsRead ($notificationId)
        {
            $client = auth()->user();

            $client->notifications()->updateExistingPivot($notificationId, ['is_read' => true]);

            return response()->json(['message' => 'Notification marked as read']);
        }
}
