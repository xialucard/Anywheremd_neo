<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'admittingOrder',
        'additional_orders',
        'operative_tech',
        'after_proc',
        'things_watch_out',
        'things_avoid',
        'wound_care',
        'created_by',
        'updated_by',
        'active'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
