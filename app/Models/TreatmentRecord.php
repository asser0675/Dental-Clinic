<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreatmentRecord extends Model
{
    protected $fillable = ['clinical_session_id', 'patient_id', 'tooth_id', 'procedure', 'notes'];
}
