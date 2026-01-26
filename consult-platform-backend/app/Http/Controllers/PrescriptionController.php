<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Http\Controllers\Controller;

class PrescriptionController extends Controller
{
    public function show(Request $request, $appointmentId)
    {
        return Presscription::where('appointment_id', $appointmentId)
            ->where(function ($q) use ($request) {
                $q->where('professional_id', $request->user()->id)
                ->orWhere('client_id', $request->user()->id);
            })
            ->firstOrFail();
    }
}
