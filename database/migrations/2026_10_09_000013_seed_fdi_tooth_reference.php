<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $q) {
            $max = $q <= 4 ? 8 : 5;
            for ($i = 1; $i <= $max; $i++) {
                DB::table('teeth')->insert(['fdi_number' => $q * 10 + $i, 'dentition' => $q <= 4 ? 'permanent' : 'primary', 'quadrant' => $q, 'position' => $i, 'label' => 'Tooth '.($q * 10 + $i), 'created_at' => now(), 'updated_at' => now()]);
            }
        }
    }

    public function down(): void
    {
        DB::table('teeth')->whereIn('fdi_number', array_merge(range(11, 18), range(21, 28), range(31, 38), range(41, 48), range(51, 55), range(61, 65), range(71, 75), range(81, 85)))->delete();
    }
};
