<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ScheduleConso extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id', 'date_from'];

    protected $fillable = [
        'clinic_id',
        'doctor_id',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'timeslot_interval',
        'days',
        'user_id',
        'created_by',
        'updated_by',
        'active'
    ];

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

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
