<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientToothRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'tooth_id',
        'condition',
        'surface_conditions',
        'notes',
        'last_updated_by',
    ];

    protected function casts(): array
    {
        return ['surface_conditions' => 'array'];
    }

    public function patient()
    {
        return $this->belongsTo(PatientRecord::class, 'patient_id');
    }

    public function tooth()
    {
        return $this->belongsTo(Tooth::class, 'tooth_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }
}
