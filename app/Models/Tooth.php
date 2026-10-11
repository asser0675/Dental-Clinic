<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tooth extends Model
{
    protected $fillable = ['fdi_number', 'dentition', 'quadrant', 'position', 'label'];

    protected $appends = ['chart_number', 'arch', 'side'];

    public function getChartNumberAttribute(): int
    {
        // The clinic chart displays the tooth's position inside its quadrant.
        // Permanent dentition therefore reads 8..1 | 1..8 and primary reads
        // 5..1 | 1..5, while FDI remains the canonical database identifier.
        return (int) $this->position;
    }

    public function getArchAttribute(): string
    {
        return in_array((int) $this->quadrant, [1, 2, 5, 6], true)
            ? 'maxillary'
            : 'mandibular';
    }

    public function getSideAttribute(): string
    {
        return in_array((int) $this->quadrant, [1, 4, 5, 8], true)
            ? 'right'
            : 'left';
    }
}
