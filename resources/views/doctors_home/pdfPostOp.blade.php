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
    <center><h3>Post Operative Instructions</h3></center>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td>Name of Patient<br>{{ $datum->patient->name }}</td>
            <td>Age<br>{{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}</td>
            <td>Sex<br>{{ $datum->patient->gender }}<</td>
        </tr>
        <tr>
            <td>Attending Physician <br>Dr. {{ $datum->doctor->name }}</td>
            <td>Diagnosis<br>{{ $datum->assessment }}</td>
            <td>Procedure<br>{{ $datum->procedure_details }} {{ $datum->procedure_plan }}</td>
        </tr>
        <tr>
            <td colspan="3">Things to expect after the procedure:<br>{!! nl2br(isset($datum->printable_form['after_proc']) ? $datum->printable_form['after_proc'] : '') !!}</td>
        </tr>
        <tr>
            <td colspan="3">Things to watch out for:<br>{!! nl2br(isset($datum->printable_form['things_watch_out']) ? $datum->printable_form['things_watch_out'] : '') !!}</td>
        </tr>
        <tr>
            <td colspan="3">Things to avoid:<br>{!! nl2br(isset($datum->printable_form['things_avoid']) ? $datum->printable_form['things_avoid'] : '') !!}</td>
        </tr>
        <tr>
            <td colspan="3">Wound care:<br>{!! nl2br(isset($datum->printable_form['wound_care']) ? $datum->printable_form['wound_care'] : '') !!}</td>
        </tr>
        <tr>
            <td colspan="3">Medications:<br>{!! nl2br(isset($datum->printable_form['medication']) ? $datum->printable_form['medication'] : '') !!}</td>
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
                <p>Date: {{ date('Y-m-d') }}</p>
            </td>
        </tr>
        <tr>
            <td>
                @if($datum->doctor->sig_pic != '')
                <img src="{{ public_path('storage/' . $datum->doctor->sig_pic) }}" style="width:1in"><br>
                @endif
                Dr. {{ $datum->doctor->name }} {{ date('Y-m-d') }}
                <p><strong>Attending Physician/ Surgeon</strong></p>
                <p>Printed Name and Signature / Date</p>
            </td>
            <td colspan="2">
                <br>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date('Y-m-d') }}
                <p><strong>Registered Nurse in Charge</strong></p>
                <p>Printed Name and Signature / Date</p>
            </td>
        </tr>
    </table>
</body>

