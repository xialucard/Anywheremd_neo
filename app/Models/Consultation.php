<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Consultation extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'advance_booking_id',
        'clinic_id',
        'patient_id',
        'client_id',
        'doctor_id',
        'fee',
        'bookingDate',
        'booking_type',
        'procedure_details',
        'complain',
        'duration',
        'others',
        'payment_mode',
        'temp',
        'height',
        'weight',
        'bpS',
        'bpD',
        'o2',
        'heart',
        'resp',
        'post_temp',
        'post_height',
        'post_weight',
        'post_bpS',
        'post_bpD',
        'post_bpOld',
        'post_o2',
        'post_heart',
        'post_resp',
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
        'time_started',
        'time_ended',
        'machine_number',
        'dialyzer',
        'mac_use',
        'acid',
        'mac_add',
        'bfr',
        'dfr',
        'setup_prime',
        'safety_check',
        'residual_test',
        'dry_weight',
        'prev_post_hd_weight',
        'pre_hd_weight',
        'post_hd_weight',
        'ktv',
        'net_uf',
        'hd_duration',
        'frequency',
        'prime',
        'other_fluids',
        'total_uf_goal',
        'weight_loss',
        'brand',
        'dose',
        'regular_dose',
        'low_dose',
        'lmwh',
        'flushing',
        'mental_status',
        'ambulation_status',
        'ambulation_status_j',
        'subjective_complaints',
        'subjective_complaints_text',
        'pe_findings',
        'pe_findings_ascites_text',
        'pe_findings_edema_text',
        'pe_findings_others_text',
        'post_mental_status',
        'post_ambulation_status',
        'post_ambulation_status_j',
        'post_subjective_complaints',
        'post_subjective_complaints_text',
        'post_pe_findings',
        'post_pe_findings_ascites_text',
        'post_pe_findings_edema_text',
        'post_pe_findings_others_text',
        'vaccess',
        'vaccess_j',
        'vaccess_detail',
        'av_fistula_detail',
        'needle_gauge',
        'number_commultation',
        'hd_catheter_detail',
        'hd_catheter_remarks',
        'hd_catheter_hgb',
        'rml',
        'hepa',
        'iv_iron',
        'epo',
        'hd_vac',
        'hd_endorsement',
        'treatment_number',
        'dialysis_complication',
        'shorten_min',
        'shorten_reason',
        'docNotesHPI',
        'docNotesSubject',
        'docNotes',
        'icd_code',
        'assessment',
        'planMed',
        'plan',
        'planRem',
        'status',
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
        'updated_by',
        'vitals_updated_by',
        'hd_started_by',
        'hd_terminated_by'
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

    public function hd_initiator()
    {
        return $this->belongsTo(User::class, 'hd_started_by');
    }

    public function hd_terminator()
    {
        return $this->belongsTo(User::class, 'hd_terminated_by');
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

    public function icd_code_obj()
    {
        return $this->belongsTo(IcdCode::class, 'icd_code', 'icd_code');
    }

    public function consultation_files()
    {
        return $this->hasMany(ConsultationFile::class, 'consultation_id');
    }

    public function consultation_meds()
    {
        return $this->hasMany(ConsultationMed::class, 'consultation_id');
    }

    public function consultation_monitorings()
    {
        return $this->hasMany(ConsultationMonitoring::class, 'consultation_id');
    }

    public function consultation_nurse_notes()
    {
        return $this->hasMany(ConsultationNurseNote::class, 'consultation_id');
    }

    public function consultation_meds_onboards()
    {
        return $this->hasMany(ConsultationMedsOnboard::class, 'consultation_id');
    }

    public function anesthesia_files()
    {
        return $this->hasMany(AnesthesiaFile::class, 'consultation_id');
    }

    public function prescription_files()
    {
        return $this->hasMany(PrescriptionFile::class, 'consultation_id');
    }

    public function doctor_files()
    {
        return $this->hasMany(DoctorFile::class, 'consultation_id');
    }

    public function nurse_files()
    {
        return $this->hasMany(NurseFile::class, 'consultation_id');
    }

    public function consultation_referals()
    {
        return $this->hasMany(Consultation::class, 'consultation_parent_id');
    }

    public function parent_consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_parent_id');
    }

    public function advance_parent_booking()
    {
        return $this->belongsTo(Consultation::class, 'advance_booking_id');
    }
    
    public function advance_booking()
    {
        return $this->hasOne(Consultation::class, 'advance_booking_id');
    }

    public function opdpatient()
    {
        return $this->hasOne(Opdpatient::class, 'anywheremd_id');
    }

}
