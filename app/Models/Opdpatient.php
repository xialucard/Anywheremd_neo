<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opdpatient extends Model
{
    use HasFactory;
    protected $table = 'opdpatient';

    protected $fillable = [
        'opid',
        'imagefile',
        'lname',
        'fname',
        'mname',
        'name',
        'suffix',
        'bday',
        'age',
        'sex',
        'adrs',
        'cityadd',
        'provadd',
        'zipcode',
        'civilstatus',
        'contactno',
        'lastconsultation',
        'temp',
        'bp',
        'weight',
        'pwd',
        'phiccode',
        'phicmembr',
        'relationtomember',
        'phicpin',
        'phicmembrname',
        'emailadd',
        'anywheremd_id',
        'anywheremd_updated',
        'drainwiz_refno',
        'drainwiz_updated',
        'status',
        'client_id'
    ];

    

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'anywheremd_id');
    }
}
