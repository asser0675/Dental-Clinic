<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();
            $t->decimal('price', 12, 2);
            $t->unsignedInteger('duration_minutes')->default(30);
            $t->boolean('active')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
