<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Clinic extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'name',
        'address',
        'tel',
        'mobile_no',
        'email',
        'website_link',
        'max_num_booking',
        'corporation',
        'user_id',
        'created_by',
        'updated_by',
    ];

    public $sortable = ['id', 'name'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function affiliated_doctors()
    {
        return $this->hasMany(AffiliatedDoctor::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'clinic_id');
    }

    public function bookings()
    {
        return $this->hasMany(Consultation::class, 'clinic_id');
    }
}
