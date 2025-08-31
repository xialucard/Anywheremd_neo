<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'file_link',
        'file_type',
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

    public function hd_starter()
    {
        return $this->belongsTo(User::class, 'hd_started_by');
    }

    public function hd_terminator()
    {
        return $this->belongsTo(User::class, 'hd_terminated_by');
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
}
