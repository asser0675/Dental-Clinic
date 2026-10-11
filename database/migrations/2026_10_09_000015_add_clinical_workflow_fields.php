<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient_records', function (Blueprint $table): void {
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
        });
        Schema::table('clinical_sessions', function (Blueprint $table): void {
            $table->json('clinical_findings')->nullable();
            $table->longText('diagnosis')->nullable();
            $table->longText('treatment_recommendations')->nullable();
            $table->longText('dentist_notes')->nullable();
            $table->json('xrays')->nullable();
        });
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE appointments MODIFY status ENUM('Pending Verification','Pending','Scheduled','Checked In','In Progress','Completed','Cancelled','No-Show') NOT NULL DEFAULT 'Pending Verification'");
        }
    }

    public function down(): void
    {
        Schema::table('patient_records', fn (Blueprint $table) => $table->dropColumn(['date_of_birth', 'gender']));
        Schema::table('clinical_sessions', fn (Blueprint $table) => $table->dropColumn(['clinical_findings', 'diagnosis', 'treatment_recommendations', 'dentist_notes', 'xrays']));
    }
};
