<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mpxn',
        'installation_date',
        'type',
    ];

    public function meter_readings()
    {
        return $this->hasMany(meter_reading::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }


}
