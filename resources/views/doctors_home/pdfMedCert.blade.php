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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
    <script type="text/javascript"> try { this.print(); } catch (e) { window.onload = window.print; } </script>

</head>
<body>
    <p>Date: {{ date('F d, Y', strtotime($datum->bookingDate)) }}</p>
    <h3 class="text-center m-0 mb-5">MEDICAL CERTIFICATE</h3>
    <p>
        To whom it may concern:<br><br>
        This is to certify that {{ $datum->patient->name }} was seen in my clinic {{ $datum->clinic->name }} today.<br><br>
        Chief Complaint:
        <ul style="list-style-type:none;">
            <li>{!!html_entity_decode($datum->complain)!!} for {{ $datum->duration }}</li>
        </ul>
        Findings:
        <ul style="list-style-type:none;">
            <li>{!!html_entity_decode(isset($referal_conso) ? $referal_conso->findings : $datum->findings)!!}</li>
            <li>Refraction:
                <ul>
                    <li>OD: {{ $datum->arod_sphere == 'No Target' ? 'No Refraction Possible' : ($datum->arod_sphere>0 ? '+' . $datum->arod_sphere : $datum->arod_sphere) . ' = ' . ($datum->arod_cylinder>0 ? '+' . $datum->arod_cylinder : $datum->arod_cylinder) . ' x ' . $datum->arod_axis }}</li>
                    <li>OS: {{ $datum->aros_sphere == 'No Target' ? 'No Refraction Possible' : ($datum->aros_sphere>0 ? '+' . $datum->aros_sphere : $datum->aros_sphere) . ' = ' . ($datum->aros_cylinder>0 ? '+' . $datum->aros_cylinder : $datum->aros_cylinder) . ' x ' . $datum->aros_axis }}</li>
                </ul>
            </li>
            <li>UCVA:
                <ul>
                    <li>OD: {{ $datum->vaod_num == 'NA' ? $datum->vaod_num : $datum->vaod_num . ' / ' . $datum->vaod_den }}</li>
                    <li>OS: {{ $datum->vaos_num == 'NA' ? $datum->vaos_num : $datum->vaos_num . ' / ' . $datum->vaos_den }}</li>
                </ul>
            </li>
            <li>BCVA:
                <ul>
                    <li>OD: {{ $datum->pinod_num == 'NA' ? $datum->pinod_num : $datum->pinod_num . ' / ' . $datum->pinod_den }}</li>
                    <li>OS: {{ $datum->pinos_num == 'NA' ? $datum->pinos_num : $datum->pinos_num . ' / ' . $datum->pinos_den }}</li>
                </ul>
            </li>
            <li>Jaeger OU: {{ $datum->jae_ou }}</li>
            <li>Jaeger OD: {{ $datum->jae_od }}</li>
            <li>Jaeger OS: {{ $datum->jae_os }}</li>
        </ul>
        Diagnosis:
        <ul style="list-style-type:none;">
            <li>{!!html_entity_decode(isset($referal_conso) ? $referal_conso->diagnosis : $datum->diagnosis)!!}</li>
        </ul>
        Recommendation:
        <ul style="list-style-type:none;">
            <li>{!!html_entity_decode(isset($referal_conso) ? $referal_conso->recommendations : $datum->recommendations)!!}</li>
        </ul>
        I certify that this information is generated from the Electronic Medical Records system in my clinic and by generating this form, my signature is hereby affixed.
    </p>
    <div class="position-absolute top-100 start-100 text-end mt-5">
        @if($datum->doctor->sig_pic != "")
        <img src="{{ public_path('storage/' . $datum->doctor->sig_pic) }}" style="width:1in"><br>
        @endif
        {{ str_pad("", strlen(isset($referal_conso) ? $referal_conso->doctor->name : $datum->doctor->name), "_", STR_PAD_LEFT) }}<br>
        Dr. {{ isset($referal_conso) ? $referal_conso->doctor->name : $datum->doctor->name }}<br>
        PRC#: {{ isset($referal_conso) ? $referal_conso->doctor->prc_number : $datum->doctor->prc_number }}
    </div>
    

</body>

