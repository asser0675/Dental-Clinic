<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentalChartEntry extends Model
{
    protected $fillable = [
        'clinical_session_id',
        'patient_id',
        'tooth_id',
        'dentist_id',
        'condition',
        'surfaces',
        'notes',
    ];

    protected function casts(): array
    {
        return ['surfaces' => 'array'];
    }

    public function clinicalSession()
    {
        return $this->belongsTo(ClinicalSession::class, 'clinical_session_id');
    }

    public function tooth()
    {
        return $this->belongsTo(Tooth::class, 'tooth_id');
    }

    public function patient()
    {
        return $this->belongsTo(PatientRecord::class, 'patient_id');
    }

    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }
}
