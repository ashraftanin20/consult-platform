<?php

namespace App\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationHisotry;
use App\Models\Appointment;

class ConsultationHistoryController extends Controller
{
    public function store(Request $request, $appointmentId)
    {
        $appointment = Appointment::where('id', $appointmentId)
            ->where('professional_id', $request->user()->id)
            ->where('status', 'Approved')
            ->firstOrFail();

        if ($appointment->history) {
            return response()->json([
                'message' => 'History alread exists for this appointment'
            ], 409);
        }

        $data = $request->validate([
            'notes' => 'required|string',
            'diagnosis' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        $history = ConsultationHistory::create([
            'appointment_id' => $appointment->id,
            'professional_id' => $appointment->professional_id,
            'client_id' => $appointment->client_id,
            ...$data
        ]);

        return response()->json($history, 201);
    }
}
