<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dentist_blocks', function (Blueprint $t) {
            $t->id();
            $t->foreignId('dentist_id')->constrained('users');
            $t->dateTime('starts_at');
            $t->dateTime('ends_at');
            $t->string('reason')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dentist_blocks');
    }
};
