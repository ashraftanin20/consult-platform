<?php

namespace App\Http\Controllers\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationHisotry;

class ConsultationHistoryController extends Controller
{
    public function show(Request $request, $appointmentId)
    {
        return ConsulationHistory::where('appointment_id', $appointmentId)
            ->where(function ($q) use ($request) {
                $q->where('professional_id', $request->user()->id)
                ->orWhere('client_id', $request->user()->id);
            })
            ->firstOrFail();
    }
}
