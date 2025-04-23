<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Consultation extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'clinic_id',
        'patient_id',
        'client_id',
        'doctor_id',
        'bookingDate',
        'booking_type',
        'procedure_details',
        'complain',
        'duration',
        'payment_mode',
        'temp',
        'height',
        'weight',
        'bpS',
        'bpD',
        'o2',
        'heart',
        'arod_sphere',
        'arod_cylinder',
        'aros_axis',
        'aros_sphere',
        'aros_cylinder',
        'arod_axis',
        'vaod_num',
        'vaod_den',
        'vaodcor_num',
        'vaodcor_den',
        'vaos_num',
        'vaos_den',
        'vaoscor_num',
        'vaoscor_den',
        'pinod_num',
        'pinod_den',
        'pinodcor_num',
        'pinodcor_den',
        'pinos_num',
        'pinos_den',
        'pinoscor_num',
        'pinoscor_den',
        'jae_ou',
        'jae_od',
        'jae_os',
        'iopod',
        'iopos',
        'docNotesHPI',
        'docNotesSubject',
        'docNotes',
        'icd_code',
        'assessment',
        'planMed',
        'plan',
        'planRem',
        'prescription',
        'findings',
        'diagnosis',
        'recommendations',
        'con_date_ao',
        'procedure_ao',
        'anesthesia_type_ao',
        'anesthesiologist_ao',
        'admittingOrder',
        'created_by',
        'updated_by'
    ];

    public $sortable = ['id'];

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
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function hmo()
    {
        return $this->belongsTo(HealthOrganization::class, 'hmo');
    }

    public function consultation_files()
    {
        return $this->hasMany(ConsultationFile::class, 'consultation_id');
    }

}
