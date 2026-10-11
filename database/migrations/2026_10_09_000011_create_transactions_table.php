<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('appointment_id')->nullable()->constrained();
            $t->foreignId('patient_id')->nullable()->constrained('patient_records');
            $t->foreignId('service_id')->nullable()->constrained();
            $t->decimal('amount', 12, 2);
            $t->string('payment_method');
            $t->enum('status', ['completed', 'voided'])->default('completed');
            $t->foreignId('recorded_by')->constrained('users');
            $t->foreignId('voided_by')->nullable()->constrained('users');
            $t->timestamp('voided_at')->nullable();
            $t->string('void_reason')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
