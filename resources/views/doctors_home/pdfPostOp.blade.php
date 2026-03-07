@php
    unset($referal_conso);
    // $referal_conso = array();
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
        @if(isset($referal_conso->clinic->letterhead_pic) && $referal_conso->clinic->letterhead_pic != '')
            <img src="{{ public_path('storage/printable_forms_files/' . $referal_conso->clinic->letterhead_pic) }}" alt="" style="width:7.35in; margin-bottom:5px">
        @elseif(!isset($referal_conso) && $datum->clinic->letterhead_pic)
            <img src="{{ public_path('storage/printable_forms_files/' . $datum->clinic->letterhead_pic) }}" alt="" style="width:7.35in; margin-bottom:5px">
        @else
        <div class="item" style="width: 3in; height:90px">
            <h1 style="margin-bottom: 5px">{{ isset($referal_conso->clinic->name) ? $referal_conso->clinic->name : (!isset($referal_conso) ? $datum->clinic->name : '') }}</h1>
        </div>
        <div class="item" style="width: 4in; height:90px">
            <p>{{ isset($referal_conso->clinic->address) ? $referal_conso->clinic->address : (!isset($referal_conso) ? $datum->clinic->address : '') }}</p>
            <p>Contact Numbers:{{ isset($referal_conso->clinic->tel) ? $referal_conso->clinic->tel : (!isset($referal_conso) ? $datum->clinic->tel : '') }}/{{ isset($referal_conso->clinic->mobile_no) ? $referal_conso->clinic->mobile_no : (!isset($referal_conso) ? $datum->clinic->mobile_no : '') }}</p>
        </div>
        @endif
    </div>
    <center><h3>Post Operative Instructions</h3></center>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td>Name of Patient<br>{{ $datum->patient->name }}</td>
            <td>Age<br>{{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}</td>
            <td>Sex<br>{{ $datum->patient->gender }}<</td>
        </tr>
        <tr>
            <td>Attending Physician <br>Dr. {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }}</td>
            <td>Diagnosis<br>{{ isset($referal_conso->assessment) ? $referal_conso->assessment : (!isset($referal_conso) ? $datum->assessment : '') }}</td>
            <td>Procedure<br>{{ isset($referal_conso->procedure_details) ? $referal_conso->procedure_details : (!isset($referal_conso) ? $datum->procedure_details : '') }}</td>
        </tr>
        <tr>
            <td colspan="3">Booking Number:{{ isset($referal_conso->id) ? $referal_conso->id : (!isset($referal_conso) ? $datum->id : '') }}</td>
        </tr>
        <tr>
            <td colspan="3">Things to expect after the procedure:<br>{!! nl2br(isset($referal_conso->printable_form['after_proc']) ? $referal_conso->printable_form['after_proc'] : (!isset($referal_conso) ? $datum->printable_form['after_proc'] : '')) !!}</td>
        </tr>
        <tr>
            <td colspan="3">Things to watch out for:<br>{!! nl2br(isset($referal_conso->printable_form['things_watch_out']) ? $referal_conso->printable_form['things_watch_out'] : (!isset($referal_conso) ? $datum->printable_form['things_watch_out'] : '')) !!}</td>
        </tr>
        <tr>
            <td colspan="3">Things to avoid:<br>{!! nl2br(isset($referal_conso->printable_form['things_avoid']) ? $referal_conso->printable_form['things_avoid'] : (!isset($referal_conso) ? $datum->printable_form['things_avoid'] : '')) !!}</td>
        </tr>
        <tr>
            <td colspan="3">Wound care:<br>{!! nl2br(isset($referal_conso->printable_form['wound_care']) ? $referal_conso->printable_form['wound_care'] : (!isset($referal_conso) ? $datum->printable_form['wound_care'] : '')) !!}</td>
        </tr>
        <tr>
            <td colspan="3">Medications:<br>{!! nl2br(isset($referal_conso->printable_form['medication']) ? $referal_conso->printable_form['medication'] : (!isset($referal_conso) ? $datum->printable_form['medication'] : '')) !!}</td>
        </tr>
        <tr>
            <td colspan="3">Follow up schedule:<br><br><br></td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>Emergency Contact for questions or clarifications:</strong><br>
                <strong>{{ $datum->clinic->name }}/{{ $datum->clinic->mobile_no }}</strong><br><br>
                <p>Patients are advised to consult healthcare professionals for any concerns. <br>
                    This discharge summary aims to ensure a smooth transition post-surgery. Patients are encouraged to follow instructions diligently and seek prompt medical attention if needed.</p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <p>I understand the abovementioned  instructions.</p><br><br>
                {{ $datum->patient->name }}
                <p><strong>Patient’s or Patient’s guardian signature over printed name</strong></p>
                <p>Date: {{ isset($referal_conso->bookingDate) ? $referal_conso->bookingDate : (!isset($referal_conso) ? $datum->bookingDate : '') }}</p>
            </td>
        </tr>
        <tr>
            <td>
                @if($datum->doctor->sig_pic != '' || $referal_conso->doctor->sig_pic)
                <img src="{{ public_path('storage/' . (isset($referal_conso->doctor->sig_pic) ? $referal_conso->doctor->sig_pic : (!isset($referal_conso) ? $datum->doctor->sig_pic : ''))) }}" style="width:1in"><br>
                @endif
                Dr. {{ isset($referal_conso->doctor->name) ? $referal_conso->doctor->name : (!isset($referal_conso) ? $datum->doctor->name : '') }} {{ isset($referal_conso->bookingDate) ? $referal_conso->bookingDate : (!isset($referal_conso) ? $datum->bookingDate : '') }}
                <p><strong>Attending Physician/ Surgeon</strong></p>
                <p>Printed Name and Signature / Date</p>
            </td>
            <td colspan="2">
                <br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ isset($referal_conso->bookingDate) ? $referal_conso->bookingDate : (!isset($referal_conso) ? $datum->bookingDate : '') }}
                <p><strong>Registered Nurse in Charge</strong></p>
                <p>Printed Name and Signature / Date</p>
            </td>
        </tr>
    </table>
</body>

