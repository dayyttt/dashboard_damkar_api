<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Member extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'sector_id',
        'nip',
        'name',
        'regu',
        'jabatan',
        'email',
        'phone',
        'address',
        'join_date',
        'password',
        'photo_path',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'join_date' => 'date',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
