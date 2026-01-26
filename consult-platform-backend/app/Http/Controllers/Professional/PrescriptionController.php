<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Prescription;

class PrescriptionController extends Controller
{
    public function store(Reqeuest $request, $appointmentId)
    {
        $appointment = Appointment::where('id', $appointmentId)
            ->where('status', 'approved')
            ->where('professional_id', $request->user()->id)
            ->firstOrFail();

        if ($appointment->prescription) {
            return response()->json([
                'message' => 'Prescription already exists for this appointment'
            ], 209);
        }

        $data = $request->validate([
            'medication' => 'required|string',
            'dosage' => 'required|string',
            'duration' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $prescription = Prescription::create([
            'appointment_id' => $appointment->id,
            'professional_id' => $appointment->professional_id,
            'client_id' => $appointment->client_id,
            ...$data
        ]);

        return response()->json($prescription, 201);
    }
}
