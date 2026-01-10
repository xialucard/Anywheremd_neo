<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Patient extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'client_id',
        'profile_pic',
        'f_name',
        'm_name',
        'l_name',
        'name',
        'gender',
        'civilStatus',
        'birthdate',
        'phil_num',
        'phil_mem_type',
        'hmo',
        'hmo_num',
        'address',
        'cityZip',
        'provinceZip',
        'email',
        'mobile_no',
        'patient_type',
        'patient_sub_type',
        'notes',
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

    public $sortable = ['id', 'name'];

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

    public function health_org()
    {
        return $this->belongsTo(HealthOrganization::class, 'hmo');
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'patient_id');
    }

}
