<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('patient_id')->nullable()->constrained('patient_records')->nullOnDelete();
            $t->foreignId('dentist_id')->constrained('users');
            $t->foreignId('service_id')->constrained('services');
            $t->string('guest_name');
            $t->string('guest_phone');
            $t->string('guest_email')->nullable();
            $t->dateTime('starts_at');
            $t->dateTime('ends_at');
            $t->enum('source', ['online', 'walk_in', 'staff'])->default('online');
            $t->enum('status', ['Pending Verification', 'Pending', 'Scheduled', 'Checked In', 'In Progress', 'Completed', 'Cancelled', 'No-Show'])->default('Pending Verification');
            $t->timestamp('verified_at')->nullable();
            $t->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $t->string('cancellation_reason')->nullable();
            $t->timestamps();
            $t->index(['dentist_id', 'starts_at', 'ends_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
