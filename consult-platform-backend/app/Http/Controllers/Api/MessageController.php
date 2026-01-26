<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;

class MessageController extends Controller
{
    public function send(Request $request, $appointmentId)
    {
        $appointment = Appointment::where('id', $appointmentId)
            ->where(function ($q) use ($request) {
                $q->where('client_id', $request->user()->id)
                    ->orWhere('professional_id', $request->user()->id);
            })
            ->firstOrFail();

        $data = $request->validate([
            'content' => 'required|string'
        ]);

        $receiverId = $request->user()->id === $appointment->client_id
            ? $appointment->professional_id
            : $appointment->cleint_id;

        $message = Message::create([
            'appointment_id' => $appointment->id,
            'sender_id' => $request->user()->id,
            'reciever_id' => $receiverId,
            'content' => $date[cotent],
        ]);

        Notification::send(
           $receiverId,
            'message_received',
            [
                'appointment_id' => $appointment->id,
                'sender_id' => $request->user()->id
            ]
        );
        
        return response->json($message, 201);
    }

    public function conversation(Request $request, $appointmentId)
    {
        Appointment::where('id', $appointmentId)
            ->where(function ($q) use ($request) {
                $q->where('client_id', $request->user()->id)
                ->orWhere('professional_id', $request->user()->id);
            })
            ->firstOrFail();

        return Message::where('appointment_id', $appointmentId)
            ->orderBy('created_at')
            ->get();
    }

    public function markAsRead(Request $request, $id)
    {
        $message = Message::where('id', $id)
            ->where('receiver_id', $request->user()->id)
            ->firstOrFail();

        $message->update(['read_at', now()]);

        return response->json(['message' => 'Marked as read']);
    }
}
