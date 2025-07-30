@php
    unset($referal_conso);
    if(isset($datum->clinic->id))
        $clinicDat = $datum->clinic->id;
    if(isset($datum->doctor->id))
        $doctorDat = $datum->doctor->id;
    $key = false;
    if(isset($datum->parent_consultation)){
        $referal_conso = $datum;
        $datum = $datum->parent_consultation;
        $key = true;
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>{{ $datum->id . '_' . $datum->patient->l_name }}.pdf</title>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <style>
        table {
            width: 100%; 
            border-collapse: collapse;
        }
        th {
            background-color: black; 
            color:white
        }
        table.table-bordered td{
            border: 1px black solid;
            padding: 5px;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .page_break { page-break-before: always; }
        .d-flex {
            text-align: center;
            justify-content: flex-start;
        }
        .d-flex {
            display: flex !important;
        }
        .justify-content-start {
            justify-content: flex-start !important;
        }
        .d-inline-flex {
            display: inline-flex !important;
        }
        .border-dark {
            border: 1px black solid;
        }
        .p-1 {
            padding: 3px;
        }
        body{
            font-size: 100%;
        }
        
    </style>
</head>
<body>
    <p>
        Name of patient: {{ $datum->patient->name }}<br>
        Age/Sex: {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}<br>
        Contemplated date of procedure: {{ date('F d, Y', strtotime($datum->con_date_ao)) }}<br>
        Procedure: {!!html_entity_decode($datum->procedure_ao)!!}<br>
        Attending MD: {{ $datum->doctor->name }} M.D.<br>
        Type of Anesthesia: {{ $datum->anesthesia_type_ao }}<br>
        Anesthesiologist: {{ $datum->anesthesiologist_ao }} M.D.
    </p>
    <h1 class='text-center'>Admitting Order</h1>
    <br>
    <p>{!!html_entity_decode($datum->admittingOrder)!!}</p>
    <br>
    <br>
    <br>
    <div class="position-absolute top-100 start-100 text-end mt-5">
        @if($datum->doctor->sig_pic != "" || $referal_conso->doctor->sig_pic != "")
        <img src="{{ public_path('storage/' . isset($referal_conso) ? $referal_conso->doctor->sig_pic : $datum->doctor->sig_pic) }}" style="width:1in"><br>
        @endif
        {{ str_pad("", strlen(isset($referal_conso) ? $referal_conso->doctor->name : $datum->doctor->name), "_", STR_PAD_LEFT) }}<br>
        Dr. {{ isset($referal_conso) ? $referal_conso->doctor->name : $datum->doctor->name }}<br>
        PRC#: {{ $datum->doctor->prc_number }}
    </div>
</body>

