<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AvailabilitySlot;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function availableSlots()
    {
        return AvailabilitySlot::where('is_booked', false)
                ->where('start_time', '>', now())
                ->with('professional:id,name')
                ->get();
    }

    public function request(Request $request)
    {
        $data = $request->validate([
            'availability_slot_id' => 'required|exists:availability_slots,id'
        ]);

        $slot = AvailabilitySlot::where('id', $data['availability_slot_id'])
                ->where('is_booked', false)
                ->firstOrFail();

        $appointment = Appointment::create([
            'professional_id' => $slot->professional_id,
            'client_id' => $request->user()->id,
            'availability_slot_id' => $slot->id,
        ]);

        $slot->update(['is_booked' => true]);

        return response()->json($appointment, 201);
    }

}
