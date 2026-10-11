<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teeth', function (Blueprint $t) {
            $t->id();
            $t->unsignedTinyInteger('fdi_number')->unique();
            $t->enum('dentition', ['permanent', 'primary']);
            $t->unsignedTinyInteger('quadrant');
            $t->unsignedTinyInteger('position');
            $t->string('label');
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teeth');
    }
};
