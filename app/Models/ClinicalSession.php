<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicalSession extends Model
{
    protected $table = 'clinical_sessions';

    protected $fillable = ['appointment_id', 'patient_id', 'dentist_id', 'dental_chart', 'clinical_findings', 'diagnosis', 'treatment_recommendations', 'dentist_notes', 'xrays', 'treatment_notes', 'prescriptions', 'finalized_at'];

    protected function casts(): array
    {
        return ['dental_chart' => 'array', 'clinical_findings' => 'array', 'xrays' => 'array', 'finalized_at' => 'datetime'];
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function prescriptionRecords()
    {
        return $this->hasMany(Prescription::class, 'clinical_session_id');
    }
}
