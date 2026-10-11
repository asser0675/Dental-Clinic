<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dental_chart_entries', function (Blueprint $t) {
            $t->id();
            $t->foreignId('clinical_session_id')->constrained();
            $t->foreignId('patient_id')->nullable()->constrained('patient_records');
            $t->foreignId('tooth_id')->constrained('teeth');
            $t->foreignId('dentist_id')->constrained('users');
            $t->string('condition');
            $t->json('surfaces')->nullable();
            $t->text('notes')->nullable();
            $t->timestamps();
            $t->index(['patient_id', 'tooth_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dental_chart_entries');
    }
};
