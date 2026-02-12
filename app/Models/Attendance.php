<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'sector_id',
        'attendance_date',
        'session',
        'check_in_time',
        'status',
        'photo_path',
        'latitude',
        'longitude',
        'location_address',
        'notes',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'check_in_time' => 'datetime:H:i',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
