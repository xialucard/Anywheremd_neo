<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'profile_pic',
        'f_name',
        'm_name',
        'l_name',
        'name',
        'gender',
        'birthdate',
        'phil_num',
        'hmo',
        'hmo_num',
        'address',
        'email',
        'mobile_no',
        'patient_type',
        'patient_sub_type',
        'referral_from',
        'pastMedicalHistory',
        'pastMedicalHistoryCancer',
        'pastMedicalHistoryOthers',
        'pastSurgicalHistory',
        'pastFamilyHistory',
        'pastFamilyHistoryCancer',
        'pastFamilyHistoryOthers',
        'pastMedication',
        'presentMedication',
        'allergies',
        'allergiesFood',
        'allergiesMedicine',
        'allergiesOthers',
        'vaccination',
        'medHistoryOthers',
        'created_by',
        'updated_by'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function hmo()
    {
        return $this->belongsTo(HealthOrganization::class, 'hmo');
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'patient_id');
    }

}
