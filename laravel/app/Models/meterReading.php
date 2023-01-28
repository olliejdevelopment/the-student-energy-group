<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meterReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'meter_id',
        'reading_value',
        'reading_date',
    ];

    public function meter()
    {
        return $this->belongsTo(meter::class);
    }

}
