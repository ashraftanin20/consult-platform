<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'professional_id',
        'client_id',
        'availability_slot_id',
        'status'
    ];

    public function slot()
    {
        return $this->belongsTo(AvailabilitySlot::class, 'availability_slot_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function history()
    {
        return $this->hasOne(ConsultationHisotry::class);
    }
}
