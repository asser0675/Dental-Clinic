<?php

namespace App\Models;

use App\Support\ClinicFormatter;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = ['patient_id', 'dentist_id', 'service_id', 'guest_name', 'guest_phone', 'guest_email', 'starts_at', 'ends_at', 'source', 'status', 'verified_at', 'verified_by', 'checked_in_at', 'cancelled_at', 'cancellation_reason', 'intake_details'];

    protected $appends = ['formatted_guest_phone'];

    protected function casts(): array
    {
        return ['starts_at' => 'datetime', 'ends_at' => 'datetime', 'intake_details' => 'array', 'verified_at' => 'datetime', 'checked_in_at' => 'datetime', 'cancelled_at' => 'datetime'];
    }

    public function setGuestPhoneAttribute(?string $value): void
    {
        $this->attributes['guest_phone'] = ClinicFormatter::normalizePhone($value);
    }

    public function getFormattedGuestPhoneAttribute(): string
    {
        return ClinicFormatter::phone($this->guest_phone);
    }

    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }

    public function patient()
    {
        return $this->belongsTo(PatientRecord::class, 'patient_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function clinicalSession()
    {
        return $this->hasOne(ClinicalSession::class);
    }
}
