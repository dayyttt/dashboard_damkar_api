<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeGpsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'device_info',
        'app_version',
        'detected_at',
        'is_read',
    ];

    protected $casts = [
        'detected_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
