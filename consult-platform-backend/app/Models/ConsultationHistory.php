<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationHistory extends Model
{
    protected $fillable = [
        'appointment_id',
        'professional_id',
        'client_id',
        'notes',
        'diagnosis',
        'recommendations',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
