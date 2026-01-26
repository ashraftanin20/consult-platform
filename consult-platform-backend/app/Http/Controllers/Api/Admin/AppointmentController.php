<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with(['client:id,name', 'professional:id,name'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }
}
