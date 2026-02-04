<?php

namespace App\Http\Controllers\Api\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class ProfessionalDashboardController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'upcoming_appointments' => Appointment::where('professional_id', $request->user()->id)
                ->where('status', 'pending')
                ->count(),
        ]);
    }
}
