<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'appointment_id',
        'professional_id',
        'client_id',
        'medication',
        'dosage',
        'duration',
        'notes',
    ];
}
