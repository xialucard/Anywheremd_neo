<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_conso_id',
        'clinic_id',
        'doctor_id',
        'dateSched',
        'timeslot',
        'days',
        'user_id',
        'created_by',
        'updated_by',
        'active'
    ];

    public function schedule_conso()
    {
        return $this->belongsTo(ScheduleConso::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

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
