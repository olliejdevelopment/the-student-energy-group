<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class meter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mpxn',
        'installation_date',
        'type',
        'estimated_annual_consumption'
    ];

    public function meter_readings()
    {
        return $this->hasMany(meterReading::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estimateReading($previousReading, $previousReadingDate, $estimatedAnnualConsumption, $estimateDate)
    {
        $previousReadingDate = Carbon::parse($previousReadingDate);
        $estimateDate = Carbon::parse($estimateDate);
    
        $daysSincePreviousReading = $estimateDate->diffInDays($previousReadingDate);
        return round($previousReading + ($estimatedAnnualConsumption / 365) * $daysSincePreviousReading);
    }

    public function getLatestReading()
    {
        return $this->meter_readings()->orderBy('reading_date', 'desc')->first();
    }


}
