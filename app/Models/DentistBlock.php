<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentistBlock extends Model
{
    protected $table = 'dentist_blocks';

    protected $fillable = ['dentist_id', 'starts_at', 'ends_at', 'reason'];

    protected function casts(): array
    {
        return ['starts_at' => 'datetime', 'ends_at' => 'datetime'];
    }
}
