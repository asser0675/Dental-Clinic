<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinical_sessions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('appointment_id')->unique()->constrained();
            $t->foreignId('patient_id')->nullable()->constrained('patient_records');
            $t->foreignId('dentist_id')->constrained('users');
            $t->json('dental_chart')->nullable();
            $t->longText('treatment_notes')->nullable();
            $t->longText('prescriptions')->nullable();
            $t->timestamp('finalized_at')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinical_sessions');
    }
};
