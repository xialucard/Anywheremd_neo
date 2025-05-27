<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'f_name',
        'm_name',
        'l_name',
        'name',
        'dob',
        'gender',
        'address',
        'tel',
        'email',
        'mobile_no',
        'designation',
        'password',
        'created_by',
        'updated_by',
        'clinic_id',
        'user_type',
        'specialty',
        'profile_pic',
        'prc_pic',
        'prc_number',
        'prc_expiry',
        'diploma_pic',
        'medSchool',
        'medgraddate',
        'residencySchool',
        'subSchool',
        'hAffiliation',
        'fee',
        'sub_header_1',
        'sub_header_2',
        'approved',
        'sig_pic',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function affiliated_clinics()
    {
        return $this->hasMany(AffiliatedDoctor::class, 'doctor_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'doctor_id');
    }

    public function scheduleConsos()
    {
        return $this->hasMany(ScheduleConso::class, 'doctor_id');
    }

    public function bookings()
    {
        return $this->hasMany(Consultation::class, 'doctor_id');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'client_id');
    }

}
