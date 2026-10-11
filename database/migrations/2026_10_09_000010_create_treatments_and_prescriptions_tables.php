<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatment_records', function (Blueprint $t) {
            $t->id();
            $t->foreignId('clinical_session_id')->constrained();
            $t->foreignId('patient_id')->nullable()->constrained('patient_records');
            $t->foreignId('tooth_id')->nullable()->constrained('teeth');
            $t->string('procedure');
            $t->text('notes')->nullable();
            $t->timestamps();
        });
        Schema::create('prescriptions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('clinical_session_id')->constrained();
            $t->foreignId('patient_id')->nullable()->constrained('patient_records');
            $t->string('medication');
            $t->string('dosage')->nullable();
            $t->string('frequency')->nullable();
            $t->text('instructions')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
        Schema::dropIfExists('treatment_records');
    }
};
