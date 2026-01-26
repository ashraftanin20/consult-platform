<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return Notification::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markAsRead(Request $request, $id)
    {
        $notifiction = Notification::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $notifiction->update(['read_at' => now()]);

        return response()->json(['message' => 'Notification marked as read']);
    }
}
