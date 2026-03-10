<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $request->validate([
            'token' => 'required|string', // Expecting a single token
        ]);

        $token = $request->input('token'); // Single FCM token

        // Get the latest notification (assuming group_id = 1 for testing)
        $notification = DB::table('tbl_notification_trigger')
            ->where('groupid', 1) // Change as needed
            // ->latest('id')
            ->first();

        if (!$notification) {
            return response()->json([
                'message' => 'No notifications found.'
            ], 404);
        }

        // Firebase credentials from .env
        $serverKey = env('FCM_SERVER_KEY');
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        // Firebase Notification Payload
        $data = [
            "to" => $token,
            "notification" => [
                "title" => $notification->title,
                "body" => $notification->description,
                "sound" => "default",
            ],
            "data" => [
                "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                "type" => "single_notification",
                "groupid" => 1,
            ],
            "priority" => "high"
        ];

        // Send request to Firebase
        $response = Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type' => 'application/json',
        ])->post($fcmUrl, $data);

        return response()->json([
            'message' => 'Notification sent successfully',
            'response' => $response->json()
        ], 200);
    }

}
