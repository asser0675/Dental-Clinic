<?php

namespace App\Models;

use App\Support\ClinicFormatter;
use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    protected $table = 'patient_records';

    protected $fillable = ['patient_code', 'name', 'date_of_birth', 'gender', 'phone', 'email', 'user_id'];

    protected $appends = ['formatted_phone', 'formatted_patient_code'];

    protected function casts(): array
    {
        return ['date_of_birth' => 'date'];
    }

    public static function nextPatientCode(): string
    {
        $year = now()->format('Y');
        $prefix = 'PT-'.$year.'-';
        $lastNumber = static::query()
            ->where('patient_code', 'like', $prefix.'%')
            ->pluck('patient_code')
            ->reduce(function (int $max, string $code): int {
                return preg_match('/^PT-\d{4}-(\d+)$/', $code, $matches)
                    ? max($max, (int) $matches[1])
                    : $max;
            }, 0);

        return sprintf('%s%04d', $prefix, $lastNumber + 1);
    }

    public function setPhoneAttribute(?string $value): void
    {
        $this->attributes['phone'] = ClinicFormatter::normalizePhone($value);
    }

    public function getFormattedPhoneAttribute(): string
    {
        return ClinicFormatter::phone($this->phone);
    }

    public function getFormattedPatientCodeAttribute(): string
    {
        return ClinicFormatter::patientCode($this->patient_code, $this->id, $this->created_at);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'patient_id');
    }
}
