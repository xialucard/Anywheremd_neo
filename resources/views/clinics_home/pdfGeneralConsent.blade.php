@php
    unset($referal_conso);
    $referal_conso = array();
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
    <title>{{ 'hd_' . $datum->id . '-' . $datum->treatment_number }}.pdf</title>
    <style>
        body {
            font-size:12pt;
            font-family: Arial, Helvetica, sans-serif;
        }
        p {
            padding: 3px;
            margin: 0px;
        }
        .item {
            display: inline-block;
            padding: 5px;
            margin: 0px;
            font-weight: bold;
            /* border: 1px solid black; */
            vertical-align: top; /* Important for alignment */
        }
        .form-check {
            display: inline-block;
            font-size:6pt;
            padding: 0px 3px;
            margin: 0px;
            vertical-align: top; /* Important for alignment */
        }
        .form-check-not-inline {
            font-size:6pt;
            padding: 0px 3px;
            margin: 0px;
            vertical-align: top; /* Important for alignment */
        }
        input[type="checkbox"] {
            vertical-align: middle; /* Aligns the checkbox vertically with the middle of the label text */
        }
        input[type="radio"] {
            vertical-align: middle; /* Aligns the radio vertically with the middle of the label text */
        }
        label {
            vertical-align: middle; /* Ensures the label also aligns with the middle */
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div>
        <div class="item" style="width: 3in; height:90px">
            <h1 style="margin-bottom: 5px">{{ $datum->clinic->name }}</h1>
        </div>
        <div class="item" style="width: 4in; height:90px">
            <p>{{ $datum->clinic->address }}</p>
            <p>Contact Numbers:{{ $datum->clinic->tel }}/{{ $datum->clinic->mobile_no }}</p>
        </div>
    </div>
    <table style="width: 100%">
        <tr>
            <td>Name:</td>
            <td>{{ $datum->patient->name }}</td>
            <td>Patient Contact #:</td>
            <td>{{ $datum->patient->mobile_no }}</td>
        </tr>
        <tr>
            <td>Date:</td>
            <td colspan="3">{{ $datum->bookingDate }}</td>
        </tr>
        <tr>
            <td>Attending Doctor:</td>
            <td colspan="3">Dr. {{ $datum->doctor->name }}</td>
        </tr>
        <tr>
            <td>Diagnosis:</td>
            <td colspan="3">{{ $datum->assessment }}</td>
        </tr>
        <tr>
            <td>Procedure:</td>
            <td colspan="3">{{ $datum->procedure_details }} {{ $datum->procedure_plan }}</td>
        </tr>
    </table>
    <center><h3>GENERAL CONSENT FOR DIAGNOSTIC AND SURGICAL PROCEDURES</h3></center>
    <p>By affixing my signature over printed name below I hereby acknowledge the following:</p>
    <ol>
        <li>I, {{ $datum->patient->name }},  of legal age, hereby state that I am a patient of Dr. {{ $datum->doctor->name }}, and have been diagnosed to have {{ $datum->assessment }}.</li>
        <li>I wish to undergo {{ $datum->procedure_details }} {{ $datum->procedure_plan }}, the purpose, process, possible complications and outcome of which have been discussed with me beforehand by my Doctor.</li>
        <li>I authorize Dr. {{ $datum->doctor->name }} to perform the procedure for my benefit, including any modification, alteration, or to institute emergency procedures to address unforeseen circumstances or complications that may arise during the procedure.</li>
        <li>I understand that Dr. {{ $datum->doctor->name }} is a visiting consultant of the {{ $datum->clinic->name }} and that the Center is merely a facility center providing the equipment and staff required for the performance of the procedure. The Center is not responsible for any medical and surgical intervention, or the lack thereof, as  provided by my doctor to which I agreed to fully. </li>
        <li>I have given my consent freely and not under any form of fear, duress, or coercion from any person associated directly or indirectly with the Center. </li>
        <li>I agree <input type="checkbox"> do not agree <input type="checkbox"> to have any or all of my medical findings used for the advancement of medicine through case presentation and discussion provided my identity is preserved and kept private.</li>
        <li>I will use the following MODE OF PAYMENT for this procedure: {{ stristr($datum->payment_mode, 'Both') ? ($datum->payment_mode = 'Both' ? 'Both Philhealth and HMO' : 'Both Philhealth, HMO and Cash') : $datum->payment_mode }} </li>
        <li>I have read and fully understood the aforementioned conditions in this consent form .</li>
        <li>The staff of {{ $datum->clinic->name }} have addressed my concerns to my satisfaction.</li>
    </ol>
    <br>
    <br>
    <br>
    <br>
    <span>{{ $datum->patient->name }} {{ $datum->bookingDate }}</span>
    <br>
    <span style="border-top: solid">Patient’s Signature over Printed Name & Date</span>
    <br>
    <br>
    <br>
    <br>
    <span>&nbsp;</span>
    <br>
    <span style="border-top: solid">Witness Signature over Printed Name & Date</span>
</body>

