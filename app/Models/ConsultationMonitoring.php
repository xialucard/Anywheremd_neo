<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationMonitoring extends Model
{
    use HasFactory;

     protected $fillable = [
        'consultation_id',
        'time_given',
        'bpS',
        'bpD',
        'heart',
        'o2',
        'ap',
        'vp',
        'tmp',
        'bfr',
        'nss',
        'ufr',
        'ufv',
        'remarks',
        'created_by',
        'updated_by',
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
