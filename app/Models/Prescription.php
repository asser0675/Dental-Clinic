<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['clinical_session_id', 'patient_id', 'medication', 'dosage', 'frequency', 'instructions'];

    public function clinicalSession()
    {
        return $this->belongsTo(ClinicalSession::class, 'clinical_session_id');
    }

    public function patient()
    {
        return $this->belongsTo(PatientRecord::class, 'patient_id');
    }
}
