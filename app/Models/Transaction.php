<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['appointment_id', 'patient_id', 'service_id', 'amount', 'payment_method', 'status', 'recorded_by', 'voided_by', 'voided_at', 'void_reason'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function patient()
    {
        return $this->belongsTo(PatientRecord::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
