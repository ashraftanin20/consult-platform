<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilitySlot extends Model
{
    protected $fillable = [
        'professional_id',
        'start_time',
        'end_time',
        'is_free',
        'price',
        'is_booked'
    ];

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }
}
