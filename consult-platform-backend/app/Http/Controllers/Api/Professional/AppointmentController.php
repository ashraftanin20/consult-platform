<?php

namespace App\Http\Controllers\Api\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\models\AvailabilitySlot;

class AppointmentController extends Controller
{
    public function pending(Request $request)
    {
        return Appointment::where('professional_id', $request->user()->id)
                ->where('status', 'pending')
                ->with(['slot', 'client:id,name,email'])
                ->get();
    }

    public function approve(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('professional_id', $request->user()->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $appointment->update(['status' => 'approved']);

        return response()->json(['message' => 'Appointment approved']);
    }

    public function cancel(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('professional_id', $request->user()->id)
            ->firstOrFail();

        $appointment->update(['status' => 'canceled']);

        $availabilitySlot = AvailabilitySlot::where('id', $appointment->availability_slot_id);
        $availabilitySlot->update(['is_booked' => false]);

        return response()->json(['message' => 'Appointment canceled']);
    }
}
