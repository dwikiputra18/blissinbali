<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushSubscriptionController extends Controller
{
    /**
     * Store a new push subscription.
     */
    public function store(Request $request)
    {
        $request->validate([
            'endpoint'        => 'required|string',
            'keys.auth'       => 'required|string',
            'keys.p256dh'     => 'required|string',
            'content_encoding' => 'nullable|string',
        ]);

        // Try web guard first, then filament guard
        $user = auth()->user() ?? auth('web')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $endpoint        = $request->input('endpoint');
        $key             = $request->input('keys.p256dh');
        $token           = $request->input('keys.auth');
        $contentEncoding = $request->input('content_encoding', 'aesgcm');

        $user->updatePushSubscription($endpoint, $key, $token, $contentEncoding);

        return response()->json(['message' => 'Subscription saved'], 201);
    }

    /**
     * Delete a push subscription.
     */
    public function destroy(Request $request)
    {
        $request->validate(['endpoint' => 'required|string']);

        $user = auth()->user() ?? auth('web')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $user->deletePushSubscription($request->input('endpoint'));

        return response()->json(['message' => 'Subscription deleted'], 200);
    }
}
