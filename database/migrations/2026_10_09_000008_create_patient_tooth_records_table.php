<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_tooth_records', function (Blueprint $t) {
            $t->id();
            $t->foreignId('patient_id')->constrained('patient_records');
            $t->foreignId('tooth_id')->constrained('teeth');
            $t->string('condition')->default('unknown');
            $t->json('surface_conditions')->nullable();
            $t->text('notes')->nullable();
            $t->foreignId('last_updated_by')->nullable()->constrained('users')->nullOnDelete();
            $t->timestamps();
            $t->unique(['patient_id', 'tooth_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_tooth_records');
    }
};
