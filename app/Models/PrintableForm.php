<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintableForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'consultation_id',
        'anesthesia_type_ot',
        'anesthesiologist_ot',
        'operative_tech',
        'after_proc',
        'things_watch_out',
        'things_avoid',
        'wound_care',
        'medication',
        'room',
        'dilate',
        'constrict',
        'intake_blood_thinner',
        'intake_maintenance_meds',
        'additional_orders',
        'i_temp',
        'i_bpS',
        'i_bpD',
        'i_o2',
        'i_remarks',
        'c_nurse',
        'o_temp',
        'o_bpS',
        'o_bpD',
        'o_o2',
        'o_remarks',
        'r_nurse',
        'datetime_nurse_notes',
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

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
}
