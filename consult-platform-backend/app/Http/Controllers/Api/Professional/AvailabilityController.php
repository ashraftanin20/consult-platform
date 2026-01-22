<?php

namespace App\Http\Controllers\Api\professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AvailabilitySlot;

class AvailabilityController extends Controller
{
   public function store(Request $request)
   {
        \Log::info('AVAILABILITY REQUEST', $request->all());
        
        $data = $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'is_free' => 'boolean',
            'price' => 'nullable|required_if:is_free,false|numeric:min:0'
        ]);

        $slot = AvailabilitySlot::create([
            'professional_id' => $request->user()->id,
            ...$data
        ]);
     
        return response()->json($slot, 201);
   } 
}
