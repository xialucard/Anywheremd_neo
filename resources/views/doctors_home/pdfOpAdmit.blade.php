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
    <center><h3>OPHTHALMOLOGY ADMITTING AND PERI-OP FORM</h3></center>
    <table cellspacing="0" width="100%">
        <tr>
            <td><strong>Name of Patient:</strong> {{ $datum->patient->name }}</td>
            <td><strong>Age/Sex:</strong> {{ floor((strtotime($datum->bookingDate) - strtotime($datum->patient->birthdate))/(60*60*24*365.25)) }}/{{ $datum->patient->gender }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Diagnosis:</strong>{{ $datum->assessment }}</td>
        </tr>
        <tr>
            <td><strong>Procedure:</strong> {{ $datum->patient->name }}</td>
            <td><strong>Anesthesia:</strong> {{ $datum->anesthesia_type_ao }}</td>
        </tr>
        <tr>
            <td><strong>Surgeon:</strong> {{ $datum->doctor->name }}</td>
            <td><strong>Anesthesiology:</strong> {{ $datum->anesthesiologist_ao }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Date:</strong> {{ $datum->bookingDate }}</td>
        </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr rowspan="2">
            <td width="40%" valign="top">
                <strong>DOCTOR’S ADMITTING ORDERS</strong><br>
                <p>PLEASE ADMIT MY PATIENT TO THE OPERATING ROOM: {{ isset($datum->printable_form['room']) && $datum->printable_form['room'] ? $datum->printable_form['room'] : '' }}</p><br>
                <p>Take Vital signs every 15 mins, one hour prior to surgery.</p><br><br>
                <p style="height:2in">PLEASE DILATE <input type="checkbox" {{ isset($datum->printable_form['dilate']) && $datum->printable_form['dilate'] ? 'checked' : '' }}> with : <br>{{ isset($datum->printable_form['dilate']) && $datum->printable_form['dilate'] ? $datum->printable_form['dilate'] : '' }}</p>
                <p style="height:2in">PLEASE CONSTRICT <input type="checkbox" {{ isset($datum->printable_form['constrict']) && $datum->printable_form['constrict'] ? 'checked' : '' }}> with : <br>{{ isset($datum->printable_form['constrict']) && $datum->printable_form['constrict'] ? $datum->printable_form['dilate'] : '' }}</p>
                <span>Dr. {{ $datum->doctor->name }}</span><br>
                <span style="border-top:1px solid">MD signature above printed name</span>
            </td>
            <td width="25%" valign="top">
                <strong>Height:</strong> {{ $datum->height }} cm<br>
                <strong>Weight:</strong> {{ $datum->weight }} kg<br><br><br><br>
                <strong>Vital Signs:</strong><br>
                <strong>BP:</strong> {{ $datum->bpS }}/{{ $datum->bpD }}<br>
                <strong>Heart Rate:</strong> {{ $datum->heart }}<br>
                <strong>O2:</strong> {{ $datum->o2 }}<br>
                <strong>Temp:</strong> {{ $datum->temp }} C<br><br>
                <strong>IOP OD:</strong> {{ $datum->iopod }}<br>
                <strong>IOP OS:</strong> {{ $datum->iopos }}<br><br>
                <strong>Remarks:</strong>
            </td>
            <td width="35%" valign="top">
                <table border="0" cellspacing="0">
                    <tr>
                        <td>
                            <strong>History of Illness</strong><br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Diabetes', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Diabetes <br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Hypertension', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Hypertension <br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Heart Disease', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Heart Disease <br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Thyroid Disease', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Thyroid Disease <br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Trauma, Accident', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Trauma, Accident <br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Asthma', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Asthma <br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Cancer', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Cancer: {{ isset($datum->patient->pastMedicalHistoryCancer) ? $datum->patient->pastMedicalHistoryCancer : '' }}<br>
                            <input type="checkbox" {{ (isset($datum->patient->pastMedicalHistory) && is_array(json_decode($datum->patient->pastMedicalHistory)) && in_array('Others', json_decode($datum->patient->pastMedicalHistory))) ? 'checked' : '' }}>Others: {{ isset($datum->patient->pastMedicalHistoryOthers) ? $datum->patient->pastMedicalHistoryOthers : '' }}<br>
                            <p>Previous Surgey: <br>{{ isset($datum->patient->pastSurgicalHistory) ? $datum->patient->pastSurgicalHistory : '' }}</p>
                            <p>Covid 19 Vaccination History: <br> {{ isset($datum->patient->vaccination) ? $datum->patient->vaccination : '' }}</p> <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td width="35%" valign="top" style="border-top: 1px solid">
                            <p style="height:2in"><input type="checkbox" {{ isset($datum->printable_form['intake_blood_thinner']) && $datum->printable_form['intake_blood_thinner'] ? 'checked' : '' }}>Intake of blood thinner or anti-coagulants eg. clopidogrel, warfarin, heparin, aspirin and the like. <br>IF YES, Date and time of last intake <br>{{ isset($datum->printable_form['intake_blood_thinner']) && $datum->printable_form['intake_blood_thinner'] ? $datum->printable_form['intake_blood_thinner'] : '' }}</p>
                            <p style="height:2in"><input type="checkbox" {{ isset($datum->printable_form['intake_maintenance_meds']) && $datum->printable_form['intake_maintenance_meds'] ? 'checked' : '' }}>Intake of maintenance medications: <br>IF YES, Meds, Date and time of last intake <br>{{ isset($datum->printable_form['intake_maintenance_meds']) && $datum->printable_form['intake_maintenance_meds'] ? $datum->printable_form['intake_maintenance_meds'] : '' }}</p>
                        </td>
                    </tr>
                </table>
            </td>
    </table>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td width="65%" rowspan="2">
                <p style="height:4in">ADDITIONAL PERI-OPERATIVE ORDERS <br> {!! nl2br(isset($datum->printable_form['additional_orders']) ? $datum->printable_form['additional_orders'] : '') !!}</p>
                <span>Dr. {{ $datum->doctor->name }}</span><br>
                <span style="border-top:1px solid">MD signature above printed name</span>
            </td>
            <td valign="top">
                <p>Intraoperative Vital Signs</p>
                <p>BP: {{ (isset($datum->printable_form['i_bpS']) && isset($datum->printable_form['i_bpD']) && $datum->printable_form['i_bpS'] != '' && $datum->printable_form['i_bpD'] != '') ? $datum->printable_form['i_bpS'] . '/' . $datum->printable_form['i_bpD'] : '' }}</p>
                <p>O2: {{ (isset($datum->printable_form['i_o2']) && $datum->printable_form['i_o2'] != '') ? $datum->printable_form['i_o2'] : '' }}</p>
                <p>Temp: {{ (isset($datum->printable_form['i_temp']) && $datum->printable_form['i_temp'] != '') ? $datum->printable_form['i_temp'] . ' C' : '' }}</p>
                <p>Remarks: {!! (isset($datum->printable_form['i_remarks']) && $datum->printable_form['i_remarks'] != '') ? $datum->printable_form['i_remarks'] : '' !!}</p><br><br>
                <p>Circulating Nurse: <br>{{ (isset($datum->printable_form['c_nurse']) && $datum->printable_form['c_nurse'] != '') ? $datum->printable_form['c_nurse'] : '' }}</p>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <p>Post Operative Vital Signs</p>
                <p>BP: {{ (isset($datum->printable_form['o_bpS']) && isset($datum->printable_form['o_bpD']) && $datum->printable_form['o_bpS'] != '' && $datum->printable_form['o_bpD'] != '') ? $datum->printable_form['o_bpS'] . '/' . $datum->printable_form['o_bpD'] : '' }}</p>
                <p>O2: {{ (isset($datum->printable_form['o_o2']) && $datum->printable_form['o_o2'] != '') ? $datum->printable_form['o_o2'] : '' }}</p>
                <p>Temp: {{ (isset($datum->printable_form['o_temp']) && $datum->printable_form['o_temp'] != '') ? $datum->printable_form['o_temp'] . ' C' : '' }}</p>
                <p>Remarks: {!! (isset($datum->printable_form['o_remarks']) && $datum->printable_form['o_remarks'] != '') ? $datum->printable_form['o_remarks'] : '' !!}</p><br><br>
                <p>Recovery Room Nurse: <br>{{ (isset($datum->printable_form['r_nurse']) &&$datum->printable_form['r_nurse'] != '') ? $datum->printable_form['r_nurse'] : '' }}</p>

            </td>
        </tr>
    </table>
    {{-- <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td width="65%" align="center">
                <p></p><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <span>Dr. {{ $datum->doctor->name }}</span><br>
                <span style="border-top:1px solid">MD signature above printed name</span>
            </td>
            <td valign="top">
                <p>Post Operative Vital Signs</p>
                <p>BP: {{ ($datum->printable_form['o_bpS'] != '' && $datum->printable_form['o_bpD'] != '') ? $datum->printable_form['o_bpS'] . '/' . $datum->printable_form['o_bpD'] : '' }}</p>
                <p>O2: {{ $datum->printable_form['o_o2'] != '' ? $datum->printable_form['o_o2'] : '' }}</p>
                <p>Temp: {{ $datum->printable_form['o_temp'] != '' ? $datum->printable_form['o_temp'] . ' C' : '' }}</p>
                <p>Remarks: {!! $datum->printable_form['o_remarks'] != '' ? $datum->printable_form['o_remarks'] : '' !!}</p><br><br>
                <p>Recovery Room Nurse: {{ $datum->printable_form['r_nurse'] != '' ? $datum->printable_form['r_nurse'] . 'C' : '' }}</p>

            </td>
        </tr>
    </table> --}}
    
</body>

